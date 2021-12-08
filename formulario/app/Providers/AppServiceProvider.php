<?php

namespace App\Providers;

use App\Services\Contracts\IUserService;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\user\UserRepository;
use App\Services\user\UserService;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
            //services
            $this->app->bind(IUserService::class,UserService::class);
            //repositories
            $this->app->bind(IUserRepository::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
