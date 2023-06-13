<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CategoryService;
use App\Services\HttpService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryService();
        });

        $this->app->singleton(Client::class, function ($app) {
            return new Client([
                'base_uri' => 'http://bookservice.test:8080/api/',
                'timeout' => 2.0,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'http_errors' => false,
                'debug' => false,
            ]);
        });

        $this->app->singleton(HttpService::class, function ($app) {
            return HttpService::getInstance();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }

    // private function registerCategoryService()
    // {

    // }
}
