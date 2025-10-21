<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class carrier
{

    public function handle(Request $request, Closure $next)
    {

        if (Auth::guard('carrier')->check()) {
            return $next($request);
        } else {
            return redirect()->route('carrier.login')->with('error', 'error');
        }
    }
}
