<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\UserObserver;
use App\User;

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
        //Users observer
        User::observe(UserObserver::class);
    }
}
