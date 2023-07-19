<?php

namespace Tests\Unit\Services;

use App\Models\Cashbook;
use App\Models\Transaction\Transaction;
use App\Models\Wallet;
use App\Services\AddBalance;
use App\Services\CreateCashbook;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCashbookTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @var
     */
    private $cashbook;


    /**
     * setUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->cashbook = app(CreateCashbook::class);
    }

    /**
     * @return void
     */
    public function test_execute(): void
    {
        $wallet = Wallet::factory()->create();
        $transaction = Transaction::factory()->create([
            'wallet_id' => $wallet->id,
        ]);
        $this->cashbook->execute($wallet->id, Cashbook::DEDUCT, 10, $transaction->id);
        $this->assertDatabaseHas('cashbooks', [
            'wallet_id' => $wallet->id,
            'transaction_id' => $transaction->id,
            'amount' => -10,
        ]);

        $this->cashbook->execute($wallet->id, Cashbook::ADD, 10, $transaction->id);
        $this->assertDatabaseHas('cashbooks', [
            'wallet_id' => $wallet->id,
            'transaction_id' => $transaction->id,
            'amount' => 10,
        ]);
    }
}
