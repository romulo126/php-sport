<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Sports\Teams\SportTeamsRepository;
use App\Repositories\Sports\Teams\Contracts\SportTeamsRepositoryContract;

class SportTeamsRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            SportTeamsRepositoryContract::class,
            SportTeamsRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            SportTeamsRepositoryContract::class,
        ];
    }
}
