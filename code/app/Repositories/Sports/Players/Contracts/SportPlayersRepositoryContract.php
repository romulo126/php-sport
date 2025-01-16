<?php

namespace App\Repositories\Sports\Players\Contracts;


interface SportPlayersRepositoryContract
{
    public function getPlayers(int $perPage = 10);

    public function insrtPlayers(array $team, array $player): void;
}
