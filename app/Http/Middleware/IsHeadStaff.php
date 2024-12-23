<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IsHeadStaff
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
        if (auth()->user()->role == 'head_staff') {
        return $next($request);
        } else if (auth()->user()->role == 'guest') {
            return redirect()->route('report.data')->with('failed', "Anda Bukan Head Staff!");
        } else {
            return redirect()->route('report.data')->with('failed', "Anda Bukan Head Staff!");
        }
    }
}
