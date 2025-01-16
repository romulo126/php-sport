<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Sports\Teams\Contracts\SportTeamsServiceContract;
use App\Services\Sports\Teams\SportTeamsService;

class SportTeamsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            SportTeamsServiceContract::class,
            SportTeamsService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            SportTeamsServiceContract::class,
        ];
    }
}
