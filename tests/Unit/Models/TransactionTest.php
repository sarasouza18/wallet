<?php

namespace Tests\Unit\Models;

use App\Models\Transaction\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_create(): void
    {
        $model = Transaction::factory()->create();

        $this->assertDatabaseHas('transactions', [
            'id' => $model->id,
        ]);
    }
}
