<?php

namespace Database\Factories\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserTypeFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => 'customer',
            'description' => 'customer',
        ];
    }
}
