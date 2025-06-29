<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;


class LessonFactory extends Factory {
    protected $model = Lesson::class;

    public function definition() {
        return [
            'title' => $this->faker->sentence(6, true),
            'content' => $this->faker->paragraphs(3, true),
            'video_url' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
            'position' => $this->faker->numberBetween(1, 20),
            'course_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
