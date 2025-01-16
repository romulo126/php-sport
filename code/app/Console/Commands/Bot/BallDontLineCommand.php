<?php

namespace App\Console\Commands\Bot;

use Illuminate\Console\Command;
use App\Jobs\Bot\BallDontLie\ApiGames;
use App\Jobs\Bot\BallDontLie\ApiPlayers;
use App\Jobs\Bot\BallDontLie\ApiTeams;

class BallDontLineCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:ball-dont-line {--specific=} {--cursor=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $specific = $this->option('specific');

        if ($specific) {
            $status = match ($specific) {
                'player' => $this->jobBotPlayer(),
                'team' => $this->jobBotTeam(),
                'game' => $this->jobBotGame(),
                default => $this->error('campo specific não encontrato para esse bot!'),
            };
            
            if (! empty($status)) {
                return 1;
            }

            return 0;
        }

        $this->jobBotAll();

        return 0;
    }

    private function jobBotAll()
    {
        $this->jobBotTeam();
        $this->jobBotPlayer();
        $this->jobBotGame();

        return false;
    }

    private function jobBotTeam()
    {
        ApiTeams::dispatch();

        return false;
    }

    private function jobBotPlayer()
    {
        $cursor = $this->option('cursor') ?? 0;

        ApiPlayers::dispatch($cursor);

        return false;
    }

    private function jobBotGame()
    {
        $cursor = $this->option('cursor') ?? 0;
        
        ApiGames::dispatch($cursor);

        return false;
    }
}
