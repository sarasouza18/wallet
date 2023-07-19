<?php

namespace Tests\Unit\Models;

use App\Models\Transaction\TransactionType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTypeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_create(): void
    {
        $model = TransactionType::factory()->create();

        $this->assertDatabaseHas('transaction_types', [
            'id' => $model->id,
        ]);
    }
}
