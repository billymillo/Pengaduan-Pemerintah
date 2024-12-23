<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IsStaff
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
        if (auth()->user()->role == 'staff') {
            return $next($request);
        }else if (auth()->user()->role == 'guest') {
            return redirect()->route('report.data')->with('failed', "Anda Bukan Staff!");
        }else {
            return redirect()->route('user.table')->with('failed', "Anda Bukan Staff!");
        }
    }
}
