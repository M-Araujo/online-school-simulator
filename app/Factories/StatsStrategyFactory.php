<?php

namespace App\Factories;

use App\Interfaces\UserStatsStrategy;
use App\Services\Stats\AdminStatsStrategy;
use App\Services\Stats\TeacherStatsStrategy;
use App\Services\Stats\StudentStatsStrategy;
use App\Models\User;

class StatsStrategyFactory {
    public static function create(User $user): UserStatsStrategy {
        if ($user->isAdmin()) {
            return new AdminStatsStrategy();
        }

        if ($user->isTeacher()) {
            return new TeacherStatsStrategy();
        }

        if ($user->isStudent()) {
            return new StudentStatsStrategy();
        }

        throw new \RuntimeException("Stats strategy not implemented for this user role.");
        //return new StudentStatsStrategy(); // Default fallback
    }
}
