<?php

namespace App\Providers;

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
        $this->app->bind(
            'App\Entity\Account\Repositories\User\UserRepositoryInterface',
            'App\Entity\Account\Repositories\User\DbRepository'
        );

        $this->app->bind(
            'App\Entity\Account\Repositories\Organization\OrganizationRepositoryInterface',
            'App\Entity\Account\Repositories\Organization\DbRepository'
        );
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
