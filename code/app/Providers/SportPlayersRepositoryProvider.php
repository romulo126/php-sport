<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Sports\Players\SportPlayersRepository;
use App\Repositories\Sports\Players\Contracts\SportPlayersRepositoryContract;

class SportPlayersRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            SportPlayersRepositoryContract::class,
            SportPlayersRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            SportPlayersRepositoryContract::class,
        ];
    }
}
