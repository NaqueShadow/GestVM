<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValideurMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        foreach(auth()->user()->roles as $role)
            if ($role->id == 7) {
                return $next($request);
            }
        return redirect()->back();
    }
}
