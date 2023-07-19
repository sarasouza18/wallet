<?php

namespace App\Services;

use App\Models\Transaction\Transaction;
use App\Models\Transaction\TransactionStatus;
use App\Models\Transaction\TransactionType;

class CreateTransaction extends Service
{
    /**
     * Create an activity type.
     *
     * @param string $walletId
     * @param string $walletPayeeId
     * @param float $amount
     * @return void
     */
    public function execute(string $walletId, string $walletPayeeId, float $amount) : void
    {
        $transaction = new Transaction();
        $transaction->wallet_id = $walletId;
        $transaction->wallet_payee_id = $walletPayeeId;
        $transaction->type_id = TransactionType::TRANSFER;
        $transaction->status_id = TransactionStatus::PROCESSING;
        $transaction->amount = $amount;
        $transaction->save();
    }

}
