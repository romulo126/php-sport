<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Bot\BallDontLie\Contracts\BallDontLieServiceContract;
use App\Services\Bot\BallDontLie\BallDontLieService;

class BallDontLieServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            BallDontLieServiceContract::class,
            BallDontLieService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            BallDontLieServiceContract::class,
        ];
    }
}
