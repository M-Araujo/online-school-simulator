<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Lesson;

class LessonProgressFactory extends Factory {

    public function definition(): array {

        return [
            'user_id' => User::factory(),
            'lesson_id' => Lesson::factory(),
            'status' => 'not_started',
        ];
    }
}
