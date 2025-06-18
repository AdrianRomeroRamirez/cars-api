<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'model' => $this->model,
            'year' => $this->year,
            'engine_type' => $this->engine_type,
            'description' => $this->description,
            'manufacturer' => [
                'id' => $this->manufacturer->id,
                'name' => $this->manufacturer->name,
                'country' => $this->manufacturer->country,
            ],
            'colors' => $this->colors->map(fn($color) => [
                'id' => $color->id,
                'name' => $color->name,
                'code' => $color->code,
            ]),
            'features' => $this->features->pluck('name'),
        ];
    }
}
