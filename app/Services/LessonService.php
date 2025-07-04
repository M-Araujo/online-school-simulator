<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Lesson;

class LessonService {
    function getCurrentLesson(Course $course): Lesson {
        dd($course);
    }
}
