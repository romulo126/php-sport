<?php

namespace App\Services\Sports\Players;

use App\Services\Sports\Players\Contracts\SportPlayersServiceContract;
use App\Repositories\Sports\Players\Contracts\SportPlayersRepositoryContract;

class SportPlayersService implements SportPlayersServiceContract
{
    public SportPlayersRepositoryContract $players;

    public function __construct(SportPlayersRepositoryContract $players)
    {
        $this->players = $players;
    }

    public function getPlayers(int $perPage = 10)
    {
        return $this->players->getPlayers($perPage);
    }


    public function getPlayer(int $id)
    {
        return $this->players->getById($id, ['team']);
    }

    public function updatePlayer(int $id, array $data)
    {
        return $this->players->update($id, $data);
    }

    public function createPlayer(array $data)
    {
        $player = $this->players->create($data)->toArray();
        

        return $this->players->getById($player['id']);
    }

    public function deletePlayer(int $id): bool
    {
       return $this->players->delete($id);
    }
}