<?php

namespace App\Http\Resources\Api\Sports\Teams;

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
            'conference' => $data['conference'] ?? null,
            'division' => $data['division'] ?? null,
            'city' => $data['city'] ?? null,
            'name' => $data['name'],
            'full_name' => $data['full_name'],
            'abbreviation' => $data['abbreviation'] ?? null,
        ];
    }
}
