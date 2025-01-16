<?php

namespace App\Services\Sports\Players\Contracts;

interface SportPlayersServiceContract
{
    public function getPlayers(int $perPage = 10);

    public function getPlayer(int $id);

    public function updatePlayer(int $id, array $data);

    public function createPlayer(array $data);

    public function deletePlayer(int $id): bool;
}