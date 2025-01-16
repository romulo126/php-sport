<?php

namespace App\Jobs\Bot\BallDontLie;

use App\Services\Bot\BallDontLie\BallDontLieService;
use App\Repositories\Sports\Players\Contracts\SportPlayersRepositoryContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ApiPlayers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private BallDontLieService $ballDontLieService;
    private SportPlayersRepositoryContract $repository;
    private const  MAX_REQUEST = 30;
    private const CACHE_KEY = 'ball_dont_lie_request';
    private int $cursor;

    /**
     * Create a new job instance.
     */
    public function __construct(int $cursor)
    {
        $this->ballDontLieService = app(BallDontLieService::class);
        $this->repository = app(SportPlayersRepositoryContract::class);
        $this->cursor = $cursor;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (! Cache::has(self::CACHE_KEY)) {
            Cache::put(self::CACHE_KEY, 0, 60);
        }

        $currentValue = Cache::get(self::CACHE_KEY);

        if ($currentValue == self::MAX_REQUEST) {
            $timeRemaining = Redis::ttl(self::CACHE_KEY);

            if ($timeRemaining > 0) {
                sleep($timeRemaining);;
            }
        }

        Cache::increment(self::CACHE_KEY);

        $players = $this->ballDontLieService->getPlayers($this->cursor);

        foreach($players['data'] as $value) {
            $this->repository->insrtPlayers($value['team'], $value);
        }

        if (isset($players['meta']['next_cursor'])) {
            Artisan::call('bot:ball-dont-line', [
                '--specific' => 'player',
                '--cursor' => $players['meta']['next_cursor'],
            ]);
        }
    }
}
