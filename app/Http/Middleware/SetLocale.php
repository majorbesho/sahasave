<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('locale')
            ?: Session::get('locale')
            ?: $this->getBrowserLocale($request)
            ?: config('app.locale');

        App::setLocale($locale);
        Session::put('locale', $locale);

        return $next($request);
    }

    private function getBrowserLocale(Request $request)
    {
        $acceptLanguage = $request->header('Accept-Language');
        if ($acceptLanguage) {
            $languages = explode(',', $acceptLanguage);
            $primary = explode(';', $languages[0])[0];

            // دعم العربية
            if (str_contains($primary, 'ar')) {
                return 'ar';
            }
        }

        return null;
    }
}
