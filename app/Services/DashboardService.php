<?php

namespace App\Services;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class DashboardService {

    function getAdminStats(){

        $userCounts = User::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role');

        $coursesCounts = Course::select('is_published', DB::raw('count(*) as total'))
            ->groupBy('is_published')->pluck('total', 'is_published'); 
        
        return [
            'total_users' => $userCounts->sum(),
            'students_count' =>  $userCounts->get('student', 0),
            'teachers_count' =>  $userCounts->get('teacher', 0),
            'admins_count' =>  $userCounts->get('admin', 0),
            'active_courses' =>  $coursesCounts->get(1,0),
            'pending_approvals' =>  $coursesCounts->get(0,0)
        ];
    }
}
