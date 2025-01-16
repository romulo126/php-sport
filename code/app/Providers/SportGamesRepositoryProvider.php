<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Sports\Games\SportGamesRepository;
use App\Repositories\Sports\Games\Contracts\SportGamesRepositoryContract;

class SportGamesRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            SportGamesRepositoryContract::class,
            SportGamesRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            SportGamesRepositoryContract::class,
        ];
    }
}
