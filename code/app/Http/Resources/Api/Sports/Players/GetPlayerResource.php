<?php

namespace App\Http\Resources\Api\Sports\Players;

use Illuminate\Http\Resources\Json\JsonResource;

class GetPlayerResource extends JsonResource
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
            'first_name' => $this['first_name'],
            'last_name' => $this['last_name'],
            'position' => $this['position'] ?? null,
            'height' => $this['height'] ?? null,
            'weight' => $this['weight'] ?? null,
            'jersey_number' => $this['jersey_number'] ?? null,
            'college' => $this['college'] ?? null,
            'country' => $this['country'] ?? null,
            'draft_year' => $this['draft_year'] ?? null,
            'draft_round' => $this['draft_round'] ?? null,
            'draft_number' => $this['draft_number'] ?? null,
            'team' => [
                'team_id' => $this['team']['id'],
                'conference' => $this['team']['conference'] ?? null,
                'division' => $this['team']['division'] ?? null,
                'city' => $this['team']['city'] ?? null,
                'name' => $this['team']['name'] ?? null,
                'full_name' => $this['team']['full_name'] ?? null,
                'abbreviation' => $this['team']['abbreviation'] ?? null,
            ],
        ];
    }
}
