<?php

namespace App\Services\Sports\Games\Contracts;

interface SportGamesServiceContract
{
    public function getGames(int $perPage = 10);

    public function getGame(int $id);

    public function updateGame(int $id, array $data);

    public function createGame(array $data);

    public function deleteGame(int $id): bool;
}