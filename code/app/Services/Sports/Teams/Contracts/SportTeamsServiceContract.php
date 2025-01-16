<?php

namespace App\Services\Sports\Teams\Contracts;

interface SportTeamsServiceContract
{
    public function getTeams(int $perPage = 10);

    public function getTeam(int $id);

    public function updateTeam(int $id, array $data);

    public function createTeam(array $data);

    public function deleteTeam(int $id): bool;
}