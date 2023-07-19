<?php

namespace Database\Factories\Transaction;

use App\Models\Transaction\TransactionStatus;
use App\Models\Transaction\TransactionType;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{

    public function definition()
    {
        return [
            'wallet_id' => Wallet::factory()->create()->id,
            'wallet_payee_id' => Wallet::factory()->create()->id,
            'type_id' => TransactionType::factory()->create()->id,
            'status_id' => TransactionStatus::factory()->create()->id,
            'amount' => 10,
        ];
    }
}
