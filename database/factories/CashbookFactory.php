<?php

namespace Database\Factories;

use App\Models\Transaction\Transaction;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

class CashbookFactory extends Factory
{

    public function definition()
    {
        return [
            'wallet_id' => Wallet::factory()->create()->id,
            'transaction_id' => Transaction::factory()->create()->id,
            'amount' => 100
        ];
    }
}
