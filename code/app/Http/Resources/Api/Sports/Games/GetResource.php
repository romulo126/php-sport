<?php

namespace App\Http\Resources\Api\Sports\Games;

use Illuminate\Http\Resources\Json\JsonResource;

class GetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->formateData(),
        ];
    }

    private function formateData(): array
    {
        if (empty($this['id'])) {
            return [];
        }
        
        return [
            'id' => $this['id'],
            'date' => $this['date'] ?? null,
            'season' => $this['season'] ?? null,
            'status' => $this['status'] ?? null,
            'period' => $this['period'] ?? null,
            'time' => $this['time'] ?? null,
            'postseason' => $this['postseason'] ?? null,
            'home_team_score' => $this['home_team_score'],
            'visitor_team_score' => $this['visitor_team_score'],
            'home_team' => [
                'team_id' => $this['homeTeam']['id'],
                'conference' => $this['homeTeam']['conference'] ?? null,
                'division' => $this['homeTeam']['division'] ?? null,
                'city' => $this['homeTeam']['city'] ?? null,
                'name' => $this['homeTeam']['name'] ?? null,
                'full_name' => $this['homeTeam']['full_name'] ?? null,
                'abbreviation' => $this['homeTeam']['abbreviation'] ?? null,
            ],
            'visitor_team' => [
                'team_id' => $this['visitorTeam']['id'],
                'conference' => $this['visitorTeam']['conference'] ?? null,
                'division' => $this['visitorTeam']['division'] ?? null,
                'city' => $this['visitorTeam']['city'] ?? null,
                'name' => $this['visitorTeam']['name'] ?? null,
                'full_name' => $this['visitorTeam']['full_name'] ?? null,
                'abbreviation' => $this['visitorTeam']['abbreviation'] ?? null,
            ],

        ];
    }
}
