<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\File;
use App\Models\Law;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FileLaw>
 */
class FileLawFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_id' => $this->faker->randomElement(File::get()),
            'law_id' => $this->faker->randomElement(Law::get()),
        ];
    }
}
