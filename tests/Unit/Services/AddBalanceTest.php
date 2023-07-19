<?php

namespace Tests\Unit\Services;

use App\Models\Wallet;
use App\Services\AddBalance;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddBalanceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @var
     */
    private $addBalance;


    /**
     * setUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->addBalance = app(AddBalance::class);
    }

    /**
     * @return void
     */
    public function test_execute(): void
    {
        $wallet = Wallet::factory()->create();
        $oldBalance = $wallet->balance;
        $this->addBalance->execute($wallet->id, 100);
        $wallet->refresh();
        $this->assertEquals($wallet->balance, $oldBalance+100);
    }
}
