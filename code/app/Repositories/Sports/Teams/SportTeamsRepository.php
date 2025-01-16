<?php

namespace App\Repositories\Sports\Teams;

use App\Models\Sports\TeamsModel;
use App\Repositories\Traits\HasRepositoryMethods;
use App\Repositories\Sports\Teams\Contracts\SportTeamsRepositoryContract;

class SportTeamsRepository implements SportTeamsRepositoryContract
{
    use HasRepositoryMethods;

    protected TeamsModel $model;

    public function __construct(TeamsModel $team)
    {
        $this->model = $team;
    }

    public function getTeams(int $perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function insrtTeams(array $team): void
    {
        $this->model->firstOrCreate(
            [
                'team_bot_id' => $team['id'],
                'conference' => $team['conference'],
                'division' => $team['division'],
                'city' => $team['city'],
                'name' => $team['name'],
                'full_name' => $team['full_name'],
                'abbreviation' => $team['abbreviation'],
            ],
            [
                'team_bot_id' => $team['id'],
                'conference' => $team['conference'],
                'division' => $team['division'],
                'city' => $team['city'],
                'name' => $team['name'],
                'full_name' => $team['full_name'],
                'abbreviation' => $team['abbreviation'],
            ]
        );
    }
}
