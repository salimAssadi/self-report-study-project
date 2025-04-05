<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticated_user extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (auth()->check()) {
                if (auth()->user()->type === 'user') {
                    return route('user.home'); 
                } else {
                    return route('user.login'); // Redirect regular users to user login
                }
            }
            return route('admin.login');
        }
    }
}
