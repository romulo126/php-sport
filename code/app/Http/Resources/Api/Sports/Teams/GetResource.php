<?php

namespace App\Http\Resources\Api\Sports\Teams;

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
            'conference' => $this['conference'] ?? null,
            'division' => $this['division'] ?? null,
            'city' => $this['city'] ?? null,
            'name' => $this['name'],
            'full_name' => $this['full_name'] ,
            'abbreviation' => $this['abbreviation'] ?? null,

        ];
    }
}
