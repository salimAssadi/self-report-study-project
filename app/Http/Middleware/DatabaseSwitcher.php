<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseSwitcher
{
    public function handle(Request $request, Closure $next)
    {
        

        return $next($request);
    }
}
