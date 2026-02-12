<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;


use Illuminate\Cache\RateLimiting\Limit;



class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });

        $this->app->resolving(\Illuminate\Http\RedirectResponse::class, function ($response, $app) {
            if (method_exists($response, 'intended') && $response->getIntendedUrl() === $app['url']->route('home')) {
                $user = $app['auth']->user();
                if ($user) {
                    if ($user->isAdmin()) {
                        return $response->setIntendedUrl($app['url']->route('admin'));
                    } elseif ($user->isDoctor()) {
                        return $response->setIntendedUrl($app['url']->route('doctor.dashboard'));
                    } elseif ($user->isPatient()) {
                        return $response->setIntendedUrl($app['url']->route('patient.dashboard'));
                    }
                }
            }
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });

        // Google OAuth Rate Limiting
        RateLimiter::for('google-auth', function (Request $request) {
            return Limit::perMinute(10)->by($request->ip());
        });

        RateLimiter::for('google-callback', function (Request $request) {
            return Limit::perMinute(15)->by($request->ip());
        });

        RateLimiter::for('google-account', function (Request $request) {
            return Limit::perHour(5)->by(optional($request->user())->id ?: $request->ip());
        });

        // Login Rate Limiting
        RateLimiter::for('login', function (Request $request) {
            $key = $request->input('email') ?: $request->ip();
            return Limit::perMinute(5)->by($key);
        });

        // Registration Rate Limiting
        RateLimiter::for('register', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip());
        });
    }
}
