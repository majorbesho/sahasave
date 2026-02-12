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
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Schema;



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
                if ($query->time > 1000) {
                    \Log::channel('daily')->warning("Slow Query Detected ({$query->time}ms): " . $query->sql, [
                        'bindings' => $query->bindings,
                        'url' => request()->fullUrl(),
                    ]);
                }
            });
        }

        Schema::defaultStringLength(191);

        // Register Google socialite driver
        Socialite::extend('google', function ($app) {
            $config = $app['config']['services.google'];

            return Socialite::buildProvider(
                \Laravel\Socialite\Two\GoogleProvider::class,
                $config
            );
        });



        // $locale = config('app.locale') == 'ar' ? 'ar' : config('app.locale');
        // App::setLocale($locale);
        // Lang::setLocale($locale);
        // Session::put('local', $locale);
        // Carbon::setLocale($locale);
        Paginator::useBootstrap();
    }
}
