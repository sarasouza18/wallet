<?php

namespace Tests\Unit\Services;

use App\Models\Wallet;
use App\Services\DeductBalance;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeductBalanceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @var Model|Application|mixed
     */
    private Model $deductBalance;


    /**
     * setUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->deductBalance = app(DeductBalance::class);
    }

    /**
     * @return void
     */
    public function test_execute(): void
    {
        $wallet = Wallet::factory()->create();
        $oldBalance = $wallet->balance;
        $this->deductBalance->execute($wallet->id, 100);
        $wallet->refresh();
        $this->assertEquals($wallet->balance, $oldBalance-100);
    }
}
