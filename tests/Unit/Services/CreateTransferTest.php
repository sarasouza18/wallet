<?php

namespace Tests\Unit\Services;

use App\Models\Transaction\TransactionStatus;
use App\Models\Transaction\TransactionType;
use App\Models\Wallet;
use App\Services\CreateTransfer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTransferTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @var Model|Application|mixed
     */
    private Model $transfer;


    /**
     * setUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->transfer = app(CreateTransfer::class);
    }

    /**
     * @return void
     */
    public function test_execute(): void
    {
        TransactionType::factory()->create();
        TransactionStatus::factory()->create();
        TransactionStatus::factory()->create([
            'title' => 'success',
            'description' => 'success'
        ]);

        TransactionStatus::factory()->create([
            'title' => 'failed',
            'description' => 'failed'
        ]);

        $wallet = Wallet::factory()->create();
        $walletPayee = Wallet::factory()->create();

        $this->transfer->execute([
            'amount' => 200,
            'wallet_id' => $wallet->id,
            'wallet_payee_id' => $walletPayee->id,
        ]);

        $wallet->refresh();
        $walletPayee->refresh();

        $this->assertEquals($wallet->balance, 800);
        $this->assertEquals($walletPayee->balance, 1200);
    }
}
