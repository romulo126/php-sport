<?php

namespace App\Repositories\Sports\Teams\Contracts;


interface SportTeamsRepositoryContract
{
    public function getTeams(int $perPage = 10);

    public function insrtTeams(array $team): void;
}
