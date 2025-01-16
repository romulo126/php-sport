<?php

namespace App\Services\Sports\Games;

use App\Services\Sports\Games\Contracts\SportGamesServiceContract;
use App\Repositories\Sports\Games\Contracts\SportGamesRepositoryContract;

class SportGamesService implements SportGamesServiceContract
{
    public SportGamesRepositoryContract $games;

    public function __construct(SportGamesRepositoryContract $games)
    {
        $this->games = $games;
    }

    public function getGames(int $perPage = 10)
    {
        return $this->games->getGames($perPage);
    }

    public function getGame(int $id)
    {
        return $this->games->getById($id, ['homeTeam', 'visitorTeam']);
    }

    public function updateGame(int $id, array $data)
    {
        return $this->games->update($id, $data);
    }

    public function createGame(array $data)
    {   
        $game = $this->games->create($data)->toArray();

        return $this->games->getById($game['id']);
    }

    public function deleteGame(int $id): bool
    {
       return $this->games->delete($id);
    }
}