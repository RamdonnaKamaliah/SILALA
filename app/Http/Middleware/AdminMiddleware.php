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
        // Jika user biasa, redirect ke user dashboard
        if (Auth::guard('web')->check()) {
            return redirect()->route('dashboard');
        }

        // Jika admin sudah login, lanjutkan
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        // Jika belum login sama sekali, redirect ke login
        return redirect('/login');
    }
}