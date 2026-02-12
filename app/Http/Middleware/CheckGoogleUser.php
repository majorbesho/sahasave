<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckGoogleUser
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
        if ($request->has('email') && $request->has('provider')) {
            $user = User::where('email', $request->email)
                ->where('provider', $request->provider)
                ->first();

            if ($user && $user->provider === 'google') {
                // يمكن توجيه المستخدم إلى صفحة تسجيل الدخول بالجوجل
                return redirect()->route('auth.google')
                    ->with('info', 'يرجى تسجيل الدخول باستخدام جوجل');
            }
        }

        return $next($request);
    }
}
