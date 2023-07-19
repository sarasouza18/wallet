<?php

namespace Tests\Unit\Factories;

use App\Models\Transaction\TransactionStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionStatusFactoryTest extends TestCase
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
        $factory = TransactionStatus::factory()->definition();
        $this->assertIsArray($factory);
    }
}
