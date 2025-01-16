<?php

namespace App\Services\Sports\Teams;

use App\Services\Sports\Teams\Contracts\SportTeamsServiceContract;
use App\Repositories\Sports\Teams\Contracts\SportTeamsRepositoryContract;

class SportTeamsService implements SportTeamsServiceContract
{
    public SportTeamsRepositoryContract $teams;

    public function __construct(SportTeamsRepositoryContract $teams)
    {
        $this->teams = $teams;
    }

    public function getTeams(int $perPage = 10)
    {
        return $this->teams->getTeams($perPage);
    }

    public function getTeam(int $id)
    {
        return $this->teams->getById($id);
    }

    public function updateTeam(int $id, array $data)
    {
        return $this->teams->update($id, $data);
    }

    public function createTeam(array $data)
    {   
        $team = $this->teams->create($data)->toArray();

        return $this->teams->getById($team['id']);
    }

    public function deleteTeam(int $id): bool
    {
       return $this->teams->delete($id);
    }
}