<?php

namespace Tests\Feature;

use App\Models\Transaction\TransactionStatus;
use App\Models\Transaction\TransactionType;
use App\Models\User\User;
use App\Models\User\UserType;
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
        $tt = TransactionType::factory()->create();
        $ts = TransactionStatus::factory()->create();
        $ts1 = TransactionStatus::factory()->create([
            'title' => 'success',
            'description' => 'success'
        ]);

        $ts2 =TransactionStatus::factory()->create([
            'title' => 'failed',
            'description' => 'failed'
        ]);

        $userType = UserType::factory()->create();
        $userType2 = UserType::factory()->create();

        $userType->id = 1;
        $userType->save();

        $userType2->id = 2;
        $userType2->save();

        $tt->id = 1;
        $tt->save();

        $ts->id = 1;
        $ts->save();

        $ts1->id = 2;
        $ts1->save();

        $ts2->id = 3;
        $ts2->save();

        $user = User::factory()->create([
            'type_id' => 1
        ]);

        $user2 = User::factory()->create([
            'type_id' => 1
        ]);

        $wallet = Wallet::factory()->create([
            'user_id' => $user->id,
        ]);

        $walletPayee = Wallet::factory()->create([
            'user_id' => $user2->id,
        ]);

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
