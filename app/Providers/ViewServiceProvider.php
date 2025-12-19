<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Specialty;
use View;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // مشاركة بيانات التخصصات مع جميع الـ views
        View::composer(['frontend.doctors.*', 'frontend.layouts.*'], function ($view) {
            $specialties = cache()->remember('main_specialties', 3600, function () {
                return Specialty::with(['activeChildren' => function ($query) {
                    $query->withCount('activeDoctors')->ordered();
                }])
                    ->main()
                    ->active()
                    ->withCount('activeDoctors')
                    ->ordered()
                    ->get();
            });

            $view->with('mainSpecialties', $specialties);
        });
    }
}
