<?php

use App\Models\User;
use App\Models\Course;

function isCourseActive(Course $course): bool {
    $now = now();
    return $course->is_published && $course->start_date <= $now && $course->end_date >= $now;
}

function isCoursePendingApproval(Course $course): bool {
    $now = now();
    return !$course->is_published && $course->start_date > $now;
}

function isCourseCompleted(Course $course): bool {
    $now = now();
    return $course->is_published && $course->end_date < $now;
}

function isUpcomingCourse(Course $course): bool {
    $now = now();
    return $course->is_published && $course->start_date > $now;
}

function isUserEnrolledInCourse(User $user, Course $course): bool {
    return $user->enrolledCourses()->where('course_id', $course->id)->exists();
}

function canUserApply(User $user, Course $course): bool {
    return !isUserEnrolledInCourse($user, $course) && $user->isStudent() && isUpcomingCourse($course);
}


// TODO: write unit tests for these functions