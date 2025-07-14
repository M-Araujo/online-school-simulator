<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redis;

class DashboardController extends Controller {
    public function index(): View {


        //  Redis::set('name', 'Taylor');

        //  \Log::info(Redis::get('name'));

        $dashboardService = new DashboardService;
        $dashboardStats = $dashboardService->getStatsFor($this->authenticatedUser);
        return view('dashboard')->with(compact('dashboardStats'));
    }
}
