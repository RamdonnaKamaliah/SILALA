<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 

class SuperAdminOnly
{
   public function handle(Request $request, Closure $next)
{
    $admin = Auth::guard('admin')->user();

    if (!$admin || !$admin->isSuperAdmin()) {
        abort(403);
    }

    return $next($request);
}
}