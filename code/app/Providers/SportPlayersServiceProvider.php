<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Sports\Players\SportPlayersService;
use App\Services\Sports\Players\Contracts\SportPlayersServiceContract;

class SportPlayersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            SportPlayersServiceContract::class,
            SportPlayersService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            SportPlayersServiceContract::class,
        ];
    }
}
