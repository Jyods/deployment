<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Law>
 */
class LawFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Paragraph' => $this->faker->randomNumber(2,100),
            'Title' => $this->faker->realTextBetween(5, 10),
            'Category' => $this->faker->randomElement(['STgB']),
            'Severity' => $this->faker->randomElement(['Category 1', 'Category 2', 'Category 3', 'Special']),
            'ShortDescription' => $this->faker->realTextBetween(5, 10),
            'Description' => $this->faker->realTextBetween(50, 100),
            'minJail' => $this->faker->randomNumber(1, 10),
            'maxJail' => $this->faker->randomNumber(2, 100),
        ];
    }
}
