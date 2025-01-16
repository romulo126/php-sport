<?php

namespace App\Repositories\Sports\Games;

use App\Models\Sports\GamesModel;
use App\Repositories\Traits\HasRepositoryMethods;
use App\Repositories\Sports\Games\Contracts\SportGamesRepositoryContract;

class SportGamesRepository implements SportGamesRepositoryContract
{
    use HasRepositoryMethods;

    protected GamesModel $model;

    public function __construct(GamesModel $game)
    {
        $this->model = $game;
    }

    public function getGames(int $perPage = 10)
    {
        return $this->model->with(['homeTeam', 'visitorTeam'])->paginate($perPage);
    }

    public function insertGames(array $homeTeam, array $visitorTeam, array $game): void
    {
        $homeTeam = $this->model->findOrCreateTeam($homeTeam['id'], $homeTeam);
        $visitorTeam = $this->model->findOrCreateTeam($visitorTeam['id'], $visitorTeam);

        $this->model->firstOrCreate(
            ['game_bot_id' => $game['id']],
            [
                'game_bot_id' => $game['id'],
                'home_team_id' => $homeTeam->id,
                'visitor_team_id' => $visitorTeam->id,
                'date' => $game['date'],
                'season' => $game['season'],
                'status' => $game['status'],
                'period' => $game['period'],
                'time' => $game['time'],
                'postseason' => $game['postseason'],
                'home_team_score' => $game['home_team_score'],
                'visitor_team_score' => $game['visitor_team_score'],
            ]
        );
    }
}
