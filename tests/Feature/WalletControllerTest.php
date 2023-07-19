<?php

namespace Tests\Feature;

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

    public function test_transfer(): void
    {
        $this->withHeaders([
            'token' => config('token'),
        ])->post(route('wallet.transfer'), [
            'amount' => 20,
            'wallet_id' => Wallet::factory()->create()->id,
            'wallet_payee_id' => Wallet::factory()->create()->id,
        ]);
    }
}
