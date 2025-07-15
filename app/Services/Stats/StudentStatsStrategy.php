<?php

namespace App\Services\Stats;

use App\Models\User;
use App\Models\Course;
use App\Interfaces\UserStatsStrategy;
use Illuminate\Support\Facades\Auth;

class StudentStatsStrategy implements UserStatsStrategy {
    public function getStats(): array {

        $userCourses = Auth::user()->enrolledCourses()->limit(3)->latest()->get();

        return [
            'userCourses' => $userCourses
        ];
    }
}
