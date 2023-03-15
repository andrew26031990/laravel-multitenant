<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CentralUser>
 */
class CentralUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'phone' => '+99890' . rand(1234567, 7654321),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'is_active' => $this->faker->boolean,
            'remember_token' => Str::random(10),
        ];

    }
}
