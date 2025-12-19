<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
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
        // الأولوية: اللغة من الرابط
        if ($request->has('lang')) {
            $locale = $request->get('lang');
            if (in_array($locale, ['en', 'ar', 'fr'])) {
                Session::put('locale', $locale);
            }
        }

        // الثاني: اللغة من الجلسة
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        }
        // الثالث: اللغة الافتراضية من التكوين
        else {
            $locale = config('app.locale', 'en');
        }

        // تعيين اللغة للتطبيق
        App::setLocale($locale);

        return $next($request);
    }
}
