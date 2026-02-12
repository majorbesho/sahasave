<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            \App\Listeners\InitializeUserWallet::class,
        ],

        \App\Events\ReferralCompleted::class => [
            \App\Listeners\ProcessReferralBonus::class,
        ],

        // \Illuminate\Auth\Events\Login::class => [
        //     \App\Listeners\CheckUserStatusAfterLogin::class,
        // ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\Appointment::observe(\App\Observers\AppointmentObserver::class);
    }
}
