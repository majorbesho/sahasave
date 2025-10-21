<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class locale
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

        if (config('locale.language')) {
            if (Session::has('locale')
             && array_key_exists(Session::get('locale'),
             config('locale.language'))) {
                App::setlocale(Session::get('locale'));

            }else{
                $userLanguage = preg_split('/[,;]/',$request->server('HTTP_ACCEPT_LANGUAGE'));
                foreach ($userLanguage as $language) {
                    if (array_key_exists($language, config('locale.language'))) {
                        //
                        App::setlocale($language);
                        setlocale(LC_TIME,config('locale.language')[$language][1]);
                        Carbon::setlocale(LC_TIME,config('locale.language')[$language][0]);
                    if (config('locale.language')[$language][2]) {
                        session(['lang-rtl'=>true]);
                    } else {
                        session()->forget('lang-rtl');
                    }
                    break;

                    }
                }
            }
        }
        return $next($request);
    }
}
