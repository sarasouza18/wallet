<?php

namespace Tests\Unit\Models;

use App\Models\Cashbook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CashbookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_create(): void
    {
        $model = Cashbook::factory()->create();

        $this->assertDatabaseHas('cashbooks', [
            'id' => $model->id,
        ]);
    }
}
