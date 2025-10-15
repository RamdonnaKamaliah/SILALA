<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user adalah user biasa, redirect ke user dashboard
        if (Auth::guard('web')->check()) {
            return redirect()->route('dashboard');
        }

        // Jika bukan admin, redirect ke login
        if (!Auth::guard('admin')->check()) {
            return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        return $next($request);
    }
}