<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(){
        $dashboardService = new DashboardService;
        $dashboardStats = $dashboardService->getStatsFor(Auth::user());
        return view('dashboard')->with(compact('dashboardStats'));
    }
}
