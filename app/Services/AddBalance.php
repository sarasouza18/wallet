<?php

namespace App\Services;

use App\Models\Wallet;
use Illuminate\Validation\ValidationException;

class AddBalance extends Service
{
    /**
     * Create an activity type.
     *
     * @param string $walletId
     * @param float $amount
     * @return void
     */
    public function execute(string $walletId, float $amount): void
    {
        $wallet = Wallet::find($walletId);
        $wallet->balance += $amount;
        $wallet->save();
    }
}
