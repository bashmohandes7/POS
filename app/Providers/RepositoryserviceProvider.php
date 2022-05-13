<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryserviceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Interfaces\DashboardInterface',
            'App\Http\Repositories\DashboardRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
