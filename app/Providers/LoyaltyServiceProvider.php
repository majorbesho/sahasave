<?php

namespace App\Providers;

use App\Models\LoyaltySetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class LoyaltyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('loyalty_settings')) {
            $settings = LoyaltySetting::all();

            foreach ($settings as $setting) {
                $value = $setting->value;
                if ($setting->type === 'integer') $value = (int)$value;
                if ($setting->type === 'boolean') $value = (bool)$value;
                if ($setting->type === 'json') $value = json_decode($value, true);
                if ($setting->type === 'decimal') $value = (float)$value;

                $key = $setting->key;
                // Remove group prefix from key if it exists (e.g. loyalty_welcome_points -> welcome_points)
                if (strpos($key, $setting->group . '_') === 0) {
                    $key = substr($key, strlen($setting->group) + 1);
                }

                if ($setting->group === 'wallet') {
                    Config::set("wallet.{$key}", $value);
                } elseif ($setting->group === 'loyalty') {
                    Config::set("loyalty.{$key}", $value);
                }
            }
        }
    }
}
