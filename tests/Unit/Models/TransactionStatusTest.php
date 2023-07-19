<?php

namespace Tests\Unit\Models;

use App\Models\Cashbook;
use App\Models\Transaction\TransactionStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionStatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_create(): void
    {
        $model = TransactionStatus::factory()->create();

        $this->assertDatabaseHas('transaction_statuses', [
            'id' => $model->id,
        ]);
    }
}
