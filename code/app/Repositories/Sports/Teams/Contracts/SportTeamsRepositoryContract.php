<?php

namespace App\Repositories\Sports\Teams\Contracts;


interface SportTeamsRepositoryContract
{
    public function getTeams(int $perPage = 10);

    public function insertTeams(array $team): void;
}
