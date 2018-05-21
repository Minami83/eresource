<?php

namespace App\Http\Middleware;

use Closure;

class CheckPustakawan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user()->hasRole('pustakawan'))
        {
            return redirect('error/403');
        }
        return $next($request);
    }
}
