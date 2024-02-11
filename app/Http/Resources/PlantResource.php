<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PlantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'age' => $this->age,
            'location' => $this->location,
            'location_xy' => $this->location_xy,
            'planned_at' => $this->planned_at,
            'manager' => $this->manager,
            'code' => $this->code,
            'blueprint' => $this->blueprint ? Storage::disk('blueprints')->url($this->blueprint) : '',
            'field' => [
                'id' => $this->quarter->field->id,
                'name' => $this->quarter->field->name,
            ],
            'quarter' => [
                'id' => $this->quarter->id,
                'name' => $this->quarter->name,
            ],
        ];
    }
}
