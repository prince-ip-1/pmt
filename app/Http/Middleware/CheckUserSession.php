<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserSession
{

    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('user_data')) {
            // user value cannot be found in session
            return redirect('/login');
        }

        return $next($request);
    }

}