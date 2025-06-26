<?php

namespace Database\Factories;

use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory {
    protected $model = Enrollment::class;

    public function definition(): array {
        return [
            'user_id' => User::factory(),
            'course_id' => Course::factory(),
            'enroled_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'completed' => $this->faker->boolean(50)
        ];
    }
}
