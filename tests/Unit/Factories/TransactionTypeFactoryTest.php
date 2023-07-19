<?php

namespace Tests\Unit\Factories;

use App\Models\Transaction\TransactionType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTypeFactoryTest extends TestCase
{
    use RefreshDatabase;

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
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create(): void
    {
        $factory = TransactionType::factory()->definition();
        $this->assertIsArray($factory);
    }
}
