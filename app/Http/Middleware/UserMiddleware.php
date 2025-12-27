<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // ✅ Kalau admin nyoba masuk area user, tendang ke admin dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // ✅ Kalau user biasa login, lanjutkan
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        // ✅ Kalau belum login, suruh login
        return redirect()->route('login');
    }
}