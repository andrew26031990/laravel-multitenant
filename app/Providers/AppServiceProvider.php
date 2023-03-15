<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\CentralUserRepositoryInterface::class,
            \App\Repositories\Eloquent\CentralUserRepository::class
        );

        $this->app->bind(
            \App\Repositories\TenantRepositoryInterface::class,
            \App\Repositories\Eloquent\TenantRepository::class
        );

        $this->app->bind(
            \App\Repositories\UserRepositoryInterface::class,
            \App\Repositories\Eloquent\UserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
