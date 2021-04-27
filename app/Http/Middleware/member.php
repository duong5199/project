<?php

namespace App\Http\Middleware;

use Closure;

class member
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->get('role') == 'member') {
            return $next($request);
        }
        return redirect('/');
    }
}






