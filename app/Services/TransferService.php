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

class CreateTransfer
{
    
    public function transfer(array $data)
    {
        $this->validate($data);

        $wallet = Wallet::find($data['wallet_id']);
        $walletPayee = Wallet::find($data['wallet_payee_id']);

        $this->validations($wallet->user->type->id, $wallet->balance, $data);

        $this->auth();

        $transaction = $this->createTransaction($wallet->id, $walletPayee->id, $data['amount']);

        app(DeductBalance::class)->execute($wallet->id, $data['amount']);

        app(CreateCashbook::class)->execute($wallet->id, Cashbook::DEDUCT, $data['amount'], $transaction->id);

        app(AddBalance::class)->execute($walletPayee->id, $data['amount']);

        app(CreateCashbook::class)->execute($walletPayee->id, Cashbook::ADD, $data['amount'], $transaction->id);

        $this->notify($transaction);

        return $transaction;
    }

    /**
     * @return void
     * @throws Exception
     */
    private function auth()
    {
        $auth = app(MockyProxy::class)->authorization();

        if (!$auth) {
            throw new Exception('not authorization');
        }
    }

    /**
     * @param Transaction $transaction
     * @return void
     */
    private function notify(Transaction $transaction)
    {
        $notify = app(MockyProxy::class)->notify();

        if ($notify) {
            $transaction->status_id = TransactionStatus::SUCCESS;
        } else {
            $transaction->status_id = TransactionStatus::FAILED;
        }
        $transaction->save();
    }

    /**
     * @return void
     */
    private function validations(string $typeId, float $balance, array $data)
    {
        app(ValidateUserType::class)->execute($typeId);

        app(ValidateBalancePayer::class)->execute($balance, $data['amount']);
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
