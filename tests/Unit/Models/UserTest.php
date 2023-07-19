<?php

namespace Tests\Unit\Models;

use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_create(): void
    {
        $model = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'id' => $model->id,
        ]);
    }
}

