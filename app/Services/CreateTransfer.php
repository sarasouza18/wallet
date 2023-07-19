<?php

namespace App\Services;

use App\Models\Cashbook;
use App\Models\Transaction\Transaction;
use App\Models\Transaction\TransactionStatus;
use App\Models\Transaction\TransactionType;
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
     * @return Transaction
     * @throws ValidationException
     */
    public function execute(array $data)
    {
        $this->validate($data);

        $wallet = Wallet::find($data['wallet_id']);
        $walletPayee = Wallet::find($data['wallet_payee_id']);

        app(ValidateUserType::class)->execute($wallet->user->type->id);

        app(ValidateBalancePayer::class)->execute($wallet->balance, $data['amount']);

        $auth = app(MockyProxy::class)->authorization();

        if (!$auth) {
            throw new Exception('not authorization');
        }

        $transaction = $this->createTransaction($wallet->id, $walletPayee->id, $data['amount']);

        app(DeductBalance::class)->execute($wallet->id, $data['amount']);

        app(CreateCashbook::class)->execute($wallet->id, Cashbook::DEDUCT, $data['amount'], $transaction->id);

        app(AddBalance::class)->execute($walletPayee->id, $data['amount']);

        app(CreateCashbook::class)->execute($walletPayee->id, Cashbook::ADD, $data['amount'], $transaction->id);

        $notify = app(MockyProxy::class)->notify();

        if ($notify) {
            $transaction->status_id = TransactionStatus::SUCCESS;
            $transaction->save();
        } else {
            $transaction->status_id = TransactionStatus::FAILED;
            $transaction->save();
        }

        return $transaction;
    }

    /**
     * @param string $walletId
     * @param string $walletPayeeId
     * @param float $amount
     * @return Transaction
     */
    public function createTransaction(string $walletId, string $walletPayeeId, float $amount) : Transaction
    {
        return Transaction::create([
            'wallet_id' => $walletId,
            'wallet_payee_id' => $walletPayeeId,
            'type_id' => TransactionType::TRANSFER,
            'status_id' => TransactionStatus::PROCESSING,
            'amount' => $amount
        ]);
    }
}
