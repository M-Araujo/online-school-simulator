<?php

namespace App\Services;

use App\Models\User;
use App\Factories\StatsStrategyFactory;

class DashboardService {

    function getStatsFor(User $user) {

        $strategy = StatsStrategyFactory::create($user);
        return $strategy->getStats($user);
    }
}
