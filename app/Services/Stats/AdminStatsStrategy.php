<?php

namespace App\Services\Stats;

use App\Models\User;
use App\Models\Course;
use App\Interfaces\UserStatsStrategy;
use Illuminate\Support\Facades\DB;

class AdminStatsStrategy implements UserStatsStrategy {
    public function getStats(): array {
        $userCounts = User::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role');

        $courseCounts = Course::select('is_published', DB::raw('count(*) as total'))
            ->groupBy('is_published')
            ->pluck('total', 'is_published');

        return [
            'totalUsers' => $userCounts->sum(),
            'studentsCount' => $userCounts->get('student', 0),
            'teachersCount' => $userCounts->get('teacher', 0),
            'adminsCount' => $userCounts->get('admin', 0),
            'activeCourses' => $courseCounts->get(1, 0),
            'pendingApprovals' => $courseCounts->get(0, 0),
        ];
    }
}
