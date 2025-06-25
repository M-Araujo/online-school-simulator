<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class IsTeacherMiddleware {
    public function handle(Request $request, Closure $next): Response {
        $user = Auth::guard('web')->user();
        if (!$user instanceof User || !$user->isTeacher()) {
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
