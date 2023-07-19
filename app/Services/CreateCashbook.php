<?php

namespace App\Services;

use App\Models\Cashbook;
use Illuminate\Validation\ValidationException;

class CreateCashbook extends Service
{

    /**
     * Create an activity type.
     *
     * @param array $data
     *
     * @return void
     */
    public function execute(string $walletId, string $operation, float $amount, string $transactionId)
    {
        $cashbook = new Cashbook();
        $cashbook->wallet_id = $walletId;
        $cashbook->transaction_id = $transactionId;
        $operation == Cashbook::DEDUCT ? $cashbook->amount = - ($amount) : $cashbook->amount = $amount;
        $cashbook->save();
    }
}
