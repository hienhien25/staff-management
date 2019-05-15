<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LogProvider extends ServiceProvider
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
        \App\User::observe('\App\Observers\UserObserver::class');
        \App\Department::observe('\App\Observers\DepartmentObserver::class');
        \App\Checkin::observe('\App\Observers\CheckinObserver::class');
        \App\Checkout::observe('\App\Observers\CheckoutObserver::class');
    }
}

