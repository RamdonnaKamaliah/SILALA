<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user adalah admin, redirect ke admin dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // Jika user biasa sudah login, lanjutkan
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        // Jika belum login sama sekali, redirect ke login
        return redirect('/login');
    }
}