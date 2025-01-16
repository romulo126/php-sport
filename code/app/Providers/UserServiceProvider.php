<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Users\Contracts\UserServiceContract;
use App\Services\Users\UserService;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserServiceContract::class,
            UserService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            UserServiceContract::class,
        ];
    }
}
