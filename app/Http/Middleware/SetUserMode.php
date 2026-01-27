<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetUserMode
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !$request->session()->has('mode')) {
            $request->session()->put('mode', 'buyer');
        }

        return $next($request);
    }
}
