<?php

namespace App\Services\Bot\BallDontLie;

use App\Enums\BallDontLiEnum;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Exceptions\TooManyRequestsException;
use Exception;
use App\Services\Bot\BallDontLie\Contracts\BallDontLieServiceContract;

class BallDontLieService implements BallDontLieServiceContract
{    
    public function getTeams(): array
    {
        return $this->ballDontLineApi(BallDontLiEnum::TEAMS_ENDPOINT);
    }

    public function getTeam(int $teamId): array
    {
        return $this->ballDontLineApi(BallDontLiEnum::TEAMS_ENDPOINT . $teamId);
    }

    public function getPlayers(int $cursor = 0): array
    {
        $payload = [
            'cursor' => $cursor,
            'per_page' => BallDontLiEnum::PER_PAGE
        ];

        return $this->ballDontLineApi(BallDontLiEnum::PLAYERS_ENDPOINT, $payload);
    }

    public function getGames(int $cursor = 0): array
    {
        $payload = [
            'cursor' => $cursor,
            'per_page' => BallDontLiEnum::PER_PAGE
        ];

        return $this->ballDontLineApi(BallDontLiEnum::GAMES_ENDPOINT, $payload);
    }

    private function ballDontLineApi(string $slug, array $payload = []): array
    {
        $response = Http::withHeaders([
            'Authorization' => config('balldontlie.api_key')
            ])->get(
                BallDontLiEnum::getBaseEndpontV1() . $slug,
                $payload
            );
        
        if ($response->status() === Response::HTTP_TOO_MANY_REQUESTS) {
            throw new TooManyRequestsException();
        }

        if ($response->successful()) {
           return $response->json() ?? []; 
        }

        throw new Exception('Ball dont lie API error: ' . $response->body(), $response->status());
    }
}