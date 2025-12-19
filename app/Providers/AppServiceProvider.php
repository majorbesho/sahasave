<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Nette\Utils\Paginator as UtilsPaginator;
use Illuminate\Support\Facades\DB;



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
     *  any application services.
     *
     * @return void
     */
    public function boot()
    {
        //


        if (env('APP_DEBUG')) {
            DB::listen(function ($query) {
                \Log::info("Query Time: {$query->time}ms - SQL: {$query->sql}");
            });
        }


        // $locale = config('app.locale') == 'ar' ? 'ar' : config('app.locale');
        // App::setLocale($locale);
        // Lang::setLocale($locale);
        // Session::put('local', $locale);
        // Carbon::setLocale($locale);
        Paginator::useBootstrap();
    }
}
