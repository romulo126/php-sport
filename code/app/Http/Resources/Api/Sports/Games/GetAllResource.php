<?php

namespace App\Http\Resources\Api\Sports\Games;

use Illuminate\Http\Resources\Json\JsonResource;

class GetAllResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->getData(),
            'current_page' => $this->currentPage(),
            'last_page' => $this->lastPage(),
            'per_page' => $this->perPage(),
            'total' => $this->total(),
        ];
    }

    private function getData(): array
    {
        foreach ($this->items() as $value) {
            $data[] = $this->formateData($value->toArray());
        }

        return $data ?? [];
    }

    private function formateData(array $data): array
    {
        return [
            'id' => $data['id'],
            'date' => $data['date'] ?? null,
            'season' => $data['season'] ?? null,
            'status' => $data['status'] ?? null,
            'period' => $data['period'] ?? null,
            'time' => $data['time'] ?? null,
            'postseason' => $data['postseason'] ?? null,
            'home_team_score' => $data['home_team_score'],
            'visitor_team_score' => $data['visitor_team_score'],
            'home_team' => [
                'team_id' => $data['home_team']['id'],
                'conference' => $data['home_team']['conference'] ?? null,
                'division' => $data['home_team']['division'] ?? null,
                'city' => $data['home_team']['city'] ?? null,
                'name' => $data['home_team']['name'] ?? null,
                'full_name' => $data['home_team']['full_name'] ?? null,
                'abbreviation' => $data['home_team']['abbreviation'] ?? null,
            ],
            'visitor_team' => [
                'team_id' => $data['visitor_team']['id'],
                'conference' => $data['visitor_team']['conference'] ?? null,
                'division' => $data['visitor_team']['division'] ?? null,
                'city' => $data['visitor_team']['city'] ?? null,
                'name' => $data['visitor_team']['name'] ?? null,
                'full_name' => $data['visitor_team']['full_name'] ?? null,
                'abbreviation' => $data['visitor_team']['abbreviation'] ?? null,
            ],
        ];
    }
}
