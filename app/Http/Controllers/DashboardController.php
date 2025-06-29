<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller {
    public function index(): View {
        $dashboardService = new DashboardService;
        $dashboardStats = $dashboardService->getStatsFor($this->authenticatedUser);
        return view('dashboard')->with(compact('dashboardStats'));
    }
}
