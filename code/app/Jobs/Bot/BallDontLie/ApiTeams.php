<?php

namespace App\Jobs\Bot\BallDontLie;

use App\Services\Bot\BallDontLie\BallDontLieService;
use App\Repositories\Sports\Teams\Contracts\SportTeamsRepositoryContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ApiTeams implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private BallDontLieService $ballDontLieService;
    private SportTeamsRepositoryContract $repository;
    private const  MAX_REQUEST = 30;
    private const CACHE_KEY = 'ball_dont_lie_request';

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->ballDontLieService = app(BallDontLieService::class);
        $this->repository = app(SportTeamsRepositoryContract::class);
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

            if($timeRemaining > 0) {
                sleep($timeRemaining);;
            }
        }

        Cache::increment(self::CACHE_KEY);

        $team = $this->ballDontLieService->getTeams();

        foreach($team['data'] as $value) {
            $this->repository->insrtTeams($value);
        }
    }
}
