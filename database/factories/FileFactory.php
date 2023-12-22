<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Entry;
use App\Models\Member;
use App\Models\User;
use App\Models\Rank;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'definition' => $this->faker->realTextBetween(5, 10),
            'date' => $this->faker->date(),
            'description' => $this->faker->realTextBetween(50, 100),
            'fine' => $this->faker->randomNumber(1,10000),
            'entry_id' => $this->faker->randomElement(Entry::get()),
            'user_id' => $this->faker->randomElement(User::get()),
            'isRestricted' => $this->faker->boolean(),
            'restrictionClass' => $this->faker->randomNumber(1,10),
            'rank_id' => $this->faker->randomElement(Rank::get()),
        ];
    }
}
