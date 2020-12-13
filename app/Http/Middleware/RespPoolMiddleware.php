<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RespPoolMiddleware
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
        if (auth()->user()->role != 4) {
            return back()->with('error', 'Chemin non authorisé');
        }
        return $next($request);
    }
}
