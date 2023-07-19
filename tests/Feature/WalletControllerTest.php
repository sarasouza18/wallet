<?php

namespace Tests\Feature;

use App\Models\Transaction\TransactionStatus;
use App\Models\Transaction\TransactionType;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WalletControllerTest  extends TestCase
{

    use RefreshDatabase, WithFaker;

    /**
     * Database first seeding
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * @return void
     */
    public function test_transfer(): void
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

        $this->withHeaders([
            'token' => config('token'),
        ])->post(route('wallet.transfer'), [
            'amount' => 200,
            'wallet_id' => $wallet->id,
            'wallet_payee_id' => $walletPayee->id,
        ])
            ->assertCreated();

        $wallet->refresh();
        $walletPayee->refresh();

        $this->assertEquals($wallet->balance, 800);
        $this->assertEquals($walletPayee->balance, 1200);
    }
}
