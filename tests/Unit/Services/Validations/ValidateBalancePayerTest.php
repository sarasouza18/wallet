<?php

namespace Tests\Unit\Services\Validations;

use App\Services\Validations\ValidateBalancePayer;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidateBalancePayerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @var Model|Application|mixed
     */
    private Model $validateBalancePayer;


    /**
     * setUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->validateBalancePayer = app(ValidateBalancePayer::class);
    }

    /**
     * @return void
     */
    public function test_execute(): void
    {
        $this->expectException(Exception::class);
        $this->validateBalancePayer->execute(90, 100);
    }
}
