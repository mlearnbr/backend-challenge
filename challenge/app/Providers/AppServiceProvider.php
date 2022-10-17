<?php

namespace App\Providers;

use App\Contract\DowngradeUserAPIInterface;
use App\Contract\FindByExternalIdInterface;
use App\Contract\ListAllUsersInterface;
use App\Contract\StoreUserAPIInterface;
use App\Contract\StoreUserInterface;
use App\Contract\UpdateUserInterface;
use App\Contract\UpgradeUserAPIInterface;
use App\Service\DowngradeUserAPIService;
use App\Service\FindByExternalIdService;
use App\Service\ListAllUsersService;
use App\Service\StoreUserAPIService;
use App\Service\StoreUserService;
use App\Service\UpdateUserService;
use App\Service\UpgradeUserAPIService;
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
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
        
        //user
        $this->app->bind(StoreUserInterface::class, StoreUserService::class);
        $this->app->bind(StoreUserAPIInterface::class, StoreUserAPIService::class);
        $this->app->bind(ListAllUsersInterface::class, ListAllUsersService::class);
        $this->app->bind(UpgradeUserAPIInterface::class, UpgradeUserAPIService::class);
        $this->app->bind(UpdateUserInterface::class, UpdateUserService::class);
        $this->app->bind(FindByExternalIdInterface::class, FindByExternalIdService::class);
        $this->app->bind(DowngradeUserAPIInterface::class, DowngradeUserAPIService::class);
        
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
