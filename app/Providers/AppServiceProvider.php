<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Department;
use App\User;
use App\Observers\UserObserver;
use App\Observers\DepartmentObserver;
use App\Checkin;
use App\Observers\CheckinObserver;
use App\Chekout;
use App\Observers\CheckoutObserver;
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
        Schema::defaultStringLength(191);
        User::observe(UserObserver::class);
        Department::observe(DepartmentObserver::class);
        Checkin::observe(CheckinObserver::class);
       /* Checkout::observe(CheckoutObserver::class);*/
    }
}
