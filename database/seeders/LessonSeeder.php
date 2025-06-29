<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Course;

class LessonSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $videoUrl = 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4';

        Course::all()->each(function ($course) use ($videoUrl) {
            $lessonCount = rand(5, 10);

            for ($i = 1; $i <= $lessonCount; $i++) {
                Lesson::create([
                    'title' => "Lesson $i of {$course->title}",
                    'content' => "This is the content for lesson $i in the course titled \"{$course->title}\".\n\n" .
                        "In this lesson, we cover topic $i in detail, with real-world examples and best practices.",
                    'video_url' => $videoUrl,
                    'position' => $i,
                    'course_id' => $course->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }
}
