<?php

namespace App\Services\Stats;

use App\Models\Course;
use App\Interfaces\UserStatsStrategy;
use Illuminate\Support\Facades\Auth;

class TeacherStatsStrategy implements UserStatsStrategy {
    public function getStats(): array {
        $activeCourses = 0;
        $pendingCourses = 0;
        $completedCourses = 0;
        $upcomingCourses = 0;

        $userCourses = Course::where('teacher_id', Auth::id())->get();

        if ($userCourses->count() > 0) {
            foreach ($userCourses as $course) {
                if (isCourseActive($course)) {
                    $activeCourses++;
                }
                if (isCoursePendingApproval($course)) {
                    $pendingCourses++;
                }
                if (isCourseCompleted($course)) {
                    $completedCourses++;
                }
                if (isUpcomingCourse($course)) {
                    $upcomingCourses++;
                }
            }
        }

        return [
            'activeCourses' => $activeCourses,
            'pendingCourses' =>  $pendingCourses,
            'completedCourses' =>  $completedCourses,
            'upcomingCourses' =>  $upcomingCourses
        ];
    }
}
