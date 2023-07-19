<?php

namespace Tests\Unit\Services\Validations;

use App\Models\User\UserType;
use App\Services\Validations\ValidateBalancePayer;
use App\Services\Validations\ValidateUserType;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidateUserTypeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @var
     */
    private $validate;


    /**
     * setUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->validate = app(ValidateUserType::class);
    }

    /**
     * @return void
     */
    public function test_execute(): void
    {
        $this->expectException(Exception::class);
        $this->validate->execute(UserType::SHOPKEEPERS);
    }
}
