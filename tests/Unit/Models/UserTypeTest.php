<?php

namespace Tests\Unit\Models;

use App\Models\User\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTypeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_create(): void
    {
        $model = UserType::factory()->create();

        $this->assertDatabaseHas('user_types', [
            'id' => $model->id,
        ]);
    }
}
