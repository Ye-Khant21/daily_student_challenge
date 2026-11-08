<?php

namespace Database\Seeders;

use App\Models\Challenge;
use Illuminate\Database\Seeder;

class ChallengeSeeder extends Seeder
{
    public function run(): void
    {
        $date = today()->toDateString();

        if (! Challenge::where('challenge_date', $date)->exists()) {
            Challenge::factory()->create([
                'title' => 'Introduce Yourself',
                'description' => 'Write three sentences about yourself and what you want to learn.',
                'challenge_date' => $date,
                'is_published' => true,
            ]);
        }
        for ($day = 1; $day <= 5; $day++) {
            $date = today()->subDays($day)->toDateString();
            if (! Challenge::where('challenge_date', $date)->exists()) {
                Challenge::factory()->create([
                    'title' => 'Challenge for ' . $date,
                    'description' => 'This is a challenge for ' . $date,
                    'challenge_date' => $date,
                    'is_published' => true,
                ]);
            }
        }
    }
}
