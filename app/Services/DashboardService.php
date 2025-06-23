<?php

namespace App\Services;

use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class DashboardService
{

    function getAdminStats()
    {
        $userCounts = User::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role');

        $coursesCounts = Course::select('is_published', DB::raw('count(*) as total'))
            ->groupBy('is_published')->pluck('total', 'is_published');

        return [
            'totalUsers' => $userCounts->sum(),
            'studentsCount' =>  $userCounts->get('student', 0),
            'teachersCount' =>  $userCounts->get('teacher', 0),
            'adminsCount' =>  $userCounts->get('admin', 0),
            'activeCourses' =>  $coursesCounts->get(1, 0),
            'endingApprovals' =>  $coursesCounts->get(0, 0)
        ];
    }

    function getTeacherStats($user)
    {
        $activeCourses = 0;
        $pendingCourses = 0;
        $completedCourses = 0;
        $upcomingCourses = 0;

        $userCourses = Course::where('teacher_id', $user->id)->get();

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


    function getStatsFor($user)
    {
        if ($user->isAdmin()) {
            return $this->getAdminStats();
        } else if ($user->isTeacher()) {
            return $this->getTeacherStats($user);
        } else {
        }
    }
}
