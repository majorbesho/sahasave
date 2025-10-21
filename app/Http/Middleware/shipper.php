<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class shipper
{

    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('shipper')->check()) {
            return $next($request);
        } else {
            return redirect()->route('shipper.login')->with('error', 'error');
        }
    }
}
