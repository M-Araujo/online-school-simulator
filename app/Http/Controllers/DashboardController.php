<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function index(){
        $dashboardService = new DashboardService;
        $dashboardStats = $dashboardService->getAdminStats();
        return view('dashboard')->with(compact('dashboardStats'));
    }
}
