<?php

namespace App\Services;

use App\Models\Cashbook;
use App\Models\Transaction\TransactionStatus;
use App\Models\Wallet;
use App\Proxys\MockyProxy;
use App\Services\Validations\ValidateBalancePayer;
use App\Services\Validations\ValidateUserType;
use Exception;
use Illuminate\Validation\ValidationException;

class CreateTransfer extends Service
{
    /**
     * Get the validation rules that apply to the service.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'wallet_id' => [
                'required',
                'exists:wallets,id',
                'string',
            ],
            'amount' => [
                'required',
                'between:1,100000000',
                'integer',
            ],
            'wallet_payee_id' => [
                'required',
                'exists:wallets,id',
                'string',
            ],
        ];
    }

    /**
     * Create an activity type.
     *
     * @param array $data
     *
     * @return void
     * @throws ValidationException
     */
    public function execute(array $data)
    {
        $this->validate($data);

        $wallet = Wallet::find($data['wallet_id']);
        $walletPayee = Wallet::find($data['wallet_payee_id']);

        app(ValidateUserType::class)->execute($wallet->userType);

        app(ValidateBalancePayer::class)->execute($wallet->balance, $data['amount']);

        $transaction = app(CreateTransaction::class)->execute($wallet->id, $walletPayee->id, $data['amount']);

        $auth = app(MockyProxy::class)->authorization();

        if (!$auth) {
            return ;
        }

        $transaction->status_id = TransactionStatus::SUCCESS;
        $transaction->save();

        app(DeductBalance::class)->execute($wallet->id, $wallet->balance, $data['amount']);

        app(CreateCashbook::class)->execute($wallet->id, Cashbook::DEDUCT, $data['amount'], $transaction->id);

        app(AddBalance::class)->execute($walletPayee->id, $wallet->balance, $data['amount']);

        app(CreateCashbook::class)->execute($walletPayee->id, Cashbook::ADD, $data['amount'], $transaction->id);

        app(MockyProxy::class)->notify();
    }
}
