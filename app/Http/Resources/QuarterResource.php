<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class QuarterResource extends JsonResource
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
            'area' => $this->area,
            'planned_at' => $this->planned_at,
            'field_id' => $this->field_id,
            'blueprint' => $this->blueprint ? Storage::disk('blueprints')->url($this->blueprint) : '',
        ];
    }
}
