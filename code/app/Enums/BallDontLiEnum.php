<?php

namespace App\Enums;

enum BallDontLiEnum: string
{
     /**
     * @var string
     */
    public const TEAMS_ENDPOINT = 'teams';
    
    /**
     * @var string
     */
    public const PLAYERS_ENDPOINT = 'players';
    
    /**
     * @var string
     */
    public const GAMES_ENDPOINT = 'games';
    
    /**
     * @var int
     */
    public const PER_PAGE = 100;

    /**
     * @return string
     */
    public static function getBaseEndpontV1(): string
    {
        return config('balldontlie.api_v1');
    }
}