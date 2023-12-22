<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Patient;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Health>
 */
class HealthFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => $this->faker->randomElement(Patient::get()),
            'user_id' => $this->faker->randomElement(User::get()),
            'status' => $this->faker->randomElement(['healthy', 'sick', 'recovered', 'dead']),
            'type' => $this->faker->randomElement(['inpatient', 'outpatient']),
            'description' => $this->faker->word,
            'reference' => $this->faker->word,
            'reference_id' => $this->faker->word,
        ];
    }
}
