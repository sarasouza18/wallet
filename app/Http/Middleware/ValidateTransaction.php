<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateTransaction
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('token') !== config('token')) {
            abort(401, '401 Not Authorization');
        }

        return $next($request);
    }
}
