<?php

namespace App\Repositories\Sports\Players;

use App\Models\Sports\PlayersModel;
use App\Repositories\Traits\HasRepositoryMethods;
use App\Repositories\Sports\Players\Contracts\SportPlayersRepositoryContract;

class SportPlayersRepository implements SportPlayersRepositoryContract
{
    use HasRepositoryMethods;

    protected PlayersModel $model;

    public function __construct(PlayersModel $player)
    {
        $this->model = $player;
    }

    public function getPlayers(int $perPage = 10)
    {
        return $this->model->with('team')->paginate($perPage);
    }

    public function insertPlayers(array $team, array $player): void
    {
        $team = $this->model->findOrCreateTeam($team['id'], $team);
    
        $this->model->firstOrCreate(
            ['player_bot_id' => $player['id']],
            [
                'player_bot_id' => $player['id'],
                'team_id' => $team->id,
                'first_name' => $player['first_name'],
                'last_name' => $player['last_name'],
                'position' => $player['position'],
                'height' => $player['height'],
                'weight' => $player['weight'],
                'jersey_number' => $player['jersey_number'],
                'college' => $player['college'],
                'country' => $player['country'],
                'draft_year' => $player['draft_year'],
                'draft_round' => $player['draft_round'],
                'draft_number' => $player['draft_number'],
            ]
        );
    }
}
