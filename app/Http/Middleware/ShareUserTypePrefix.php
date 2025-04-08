<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShareUserTypePrefix
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $userType = auth()->user()->type;
            $prefix = strtolower(str_replace(' ', '_', $userType));
            View::share('route_prefix', $prefix);
        }

        return $next($request);
    }
}
