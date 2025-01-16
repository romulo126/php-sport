<?php

namespace App\Services\Bot\Contracts;

interface SportsDataProviderContract
{
    /**
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getTeams(): array;

    /**
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getTeam(int $teamId): array;

    /**
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getPlayers(int $cursor = 0): array;

    /**
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getGames(int $cursor = 0): array;
}