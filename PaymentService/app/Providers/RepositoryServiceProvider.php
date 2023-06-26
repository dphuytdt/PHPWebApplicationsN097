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
            \App\Interfaces\CartRepositoryInterface::class,
            \App\Repositories\CartRepository::class
        );

        $this->app->bind(
            \App\Interfaces\WishlistRepositoryInterface::class,
            \App\Repositories\WishlistRepository::class
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
