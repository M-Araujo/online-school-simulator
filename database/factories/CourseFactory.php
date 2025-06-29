<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CourseFactory extends Factory {

    public function definition(): array {

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'teacher_id' => User::factory(),
            'duration_hours' => 10,
            'content' => $this->faker->paragraph,
            'start_date' => now(),
            'end_date' => now()->addWeeks(4),
            'schedule' => json_encode([
                'days' => ['Monday', 'Wednesday'],
                'time' => '10:00 AM - 12:00 PM',
            ]),
            'is_published' => true,
        ];
    }
}
