<?php

namespace Database\Factories;

use App\Models\Challenge;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

/**
 * @extends Factory<Challenge>
 */
class ChallengeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by' => User::factory(), // 
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'challenge_date' => fake()->unique()->date(),
            'max_points' => 10,
            'is_published' => false,
        ];
    }
}
