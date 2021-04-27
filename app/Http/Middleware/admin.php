<?php

namespace App\Http\Middleware;

use Closure;

class admin
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
        // nếu user login = admin -> thực hiện next đến trang chức năng
        if ($request->session()->get('role') == 'admin') {
            return $next($request);
        }
        // nếu ko là admin thì trở về trang timekeeping hoặc giữ nguyên trang hiện tại
        return redirect('/');
    }
}
