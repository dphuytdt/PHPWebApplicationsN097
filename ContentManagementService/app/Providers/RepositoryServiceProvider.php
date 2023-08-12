<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Interfaces\NewsRepositoryInterfaces',
            'App\Repositories\NewsRepository'
        );
        $this->app->bind(
            'App\Interfaces\SlideShowRepositoryInterfaces',
            'App\Repositories\SlideShowRepository'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
