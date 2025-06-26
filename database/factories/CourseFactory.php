<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'teacher_id' => User::factory(), // Or a real teacher ID
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
