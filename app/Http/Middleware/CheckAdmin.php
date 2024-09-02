<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (!auth()->user() || !auth()->user()->isAdmin) {
            return redirect('/');
        }

        return $next($request);
    }
}
