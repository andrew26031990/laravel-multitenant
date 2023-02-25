<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //автоматизировать

        $this->app->bind(
            \App\Repositories\TestLogRepositoryInterface::class,
            \App\Repositories\Eloquent\TestLogRepository::class
        );

        $this->app->bind(
            \App\Repositories\TestRepositoryInterface::class,
            \App\Repositories\Eloquent\TestRepository::class
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
