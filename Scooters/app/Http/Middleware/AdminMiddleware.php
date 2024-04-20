<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isEmployee()) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
