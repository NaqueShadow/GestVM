<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GestParcMiddleware
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
        if (auth()->user()->role != 5) {
            return back()->with('error', 'Chemin non authorisé');
        }

        else return $next($request);
    }
}
