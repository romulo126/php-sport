<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Sports\Games\Contracts\SportGamesServiceContract;
use App\Services\Sports\Games\SportGamesService;

class SportGamesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            SportGamesServiceContract::class,
            SportGamesService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            SportGamesServiceContract::class,
        ];
    }
}
