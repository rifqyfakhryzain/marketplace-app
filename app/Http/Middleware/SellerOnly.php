<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerOnly
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check() || ! Auth::user()->hasRole('seller')) {
            abort(403, 'Hanya seller yang boleh mengakses halaman ini');
        }

        return $next($request);
    }
}
