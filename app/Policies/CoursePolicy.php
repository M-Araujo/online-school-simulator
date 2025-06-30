<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy {
    /**
     * Determine whether the user can view the lessons of the course.
     */
    public function viewLessons(User $user, Course $course): bool {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isTeacher()) {
            return $course->teacher_id === $user->id;
        }

        if ($user->isStudent()) {
            return $user->enrolledCourses->contains($course->id);
        }

        return false;
    }
}
