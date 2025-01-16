<?php

namespace App\Http\Resources\Api\Sports\Players;

use Illuminate\Http\Resources\Json\JsonResource;

class GetAllPlayersResource extends JsonResource
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
        foreach($this->items() as $value) {
            $data[] = $this->formateData($value->toArray());
        }

        return $data ?? [];
    }

    private function formateData(array $data): array
    {
        return [
            'id' => $data['id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'position' => $data['position'],
            'height' => $data['height'],
            'weight' => $data['weight'],
            'jersey_number' => $data['jersey_number'],
            'college' => $data['college'],
            'country' => $data['country'],
            'draft_year' => $data['draft_year'],
            'draft_round' => $data['draft_round'],
            'draft_number' => $data['draft_number'],
            'team' => [
                'team_id' => $data['team']['id'],
                'conference' => $data['team']['conference'] ?? null,
                'division' => $data['team']['division'] ?? null,
                'city' => $data['team']['city'] ?? null,
                'name' => $data['team']['name'] ?? null,
                'full_name' => $data['team']['full_name'] ?? null,
                'abbreviation' => $data['team']['abbreviation'] ?? null,
            ],
        ];
    }
}
