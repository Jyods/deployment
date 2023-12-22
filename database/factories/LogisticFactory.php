<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Logistic>
 */
class LogisticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->realTextBetween(5, 10),
            'description' => $this->faker->realTextBetween(50, 100),
            'stock' => $this->faker->randomNumber(2, 100),
            'ordered' => $this->faker->randomNumber(2, 100),
            'inuse' => $this->faker->randomNumber(2, 100),
            'used' => $this->faker->randomNumber(2, 100),
            'price' => $this->faker->randomNumber(2, 100000),
        ];
    }
}
