<?php

use App\Models\Course;

function isCourseActive(Course $course): bool{
    $now = now();
    return $course->is_published && $course->start_date <= $now && $course->end_date >= $now;
}

function isCoursePendingApproval(Course $course): bool{
    $now = now();
    return !$course->is_published && $course->start_date > $now;
}

function isCourseCompleted(Course $course): bool{
    $now = now();
    return $course->is_published && $course->end_date < $now;
}

function isUpcomingCourse(Course $course): bool
{
    $now = now();
    return $course->is_published && $course->start_date > $now;
}