<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Lesson;

class LessonService {
    function getCurrentLesson(Course $course): ?Lesson {

        $lesson = $course->lessons
            ->filter(fn($lesson) => in_array($lesson->status, ['not_started', 'ongoing']))
            ->first();

        if (!$lesson) {
            // fallback to the first lesson no matter what
            $lesson = $course->lessons->first();
        }
        return $lesson ?: null;
    }
}
