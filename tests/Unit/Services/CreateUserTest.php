<?php

namespace Tests\Unit\Services;

use App\Models\User\User;
use App\Services\CreateUser;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @var Model|Application|mixed
     */
    private Model $user;


    /**
     * setUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = app(CreateUser::class);
    }

    /**
     * @return void
     */
    public function test_execute(): void
    {
        $data = User::factory()->definition();

        $user = $this->user->execute($data);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }
}
