<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Multi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == '1' || Auth::user()->role_id == '3') {
                return $next($request);
            } else {
                return redirect()->route('home')->with('error',"Anda Tidak Dapat mengakses halaman ini");
            }
        } else {
            return redirect('/home')->with('status', ' pleaselogin first');
        }
    }
}
