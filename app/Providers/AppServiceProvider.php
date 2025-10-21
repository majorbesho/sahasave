<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Nette\Utils\Paginator as UtilsPaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        $locale = config('app.locale') == 'ar' ? 'ar' : config('app.locale');
        App::setLocale($locale);
        Lang::setLocale($locale);
        Session::put('local', $locale);
        Carbon::setLocale($locale);
        //UtilsPaginator::useBootstrapFive();
    }
}
