<?php

namespace App\Providers;

use Helpers\ADC\ADCAuth;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ADCAuth::class, function() {
            return new ADCAuth(
                request()->input('credentials.username', env('ADC_USERNAME')),
                request()->input('credentials.password', env('ADC_PASSWORD')),
                request()->input('credentials.branchID', 0),
                request()->input('credentials.twoFactor', '')
            );
        });

        $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        $this->app->register(TelescopeServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
