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

        $this->app->bind(
            \App\Repositories\EmployeeRepositoryInterface::class,
            \App\Repositories\Eloquent\EmployeeRepository::class
        );

        $this->app->bind(
            \App\Repositories\TenantRepositoryInterface::class,
            \App\Repositories\Eloquent\TenantRepository::class
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
