<?php

namespace Tests\Unit\Models;

use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WalletTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_create(): void
    {
        $model = Wallet::factory()->create();

        $this->assertDatabaseHas('wallets', [
            'id' => $model->id,
        ]);
    }
}
