<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FieldResource extends JsonResource
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
            'location' => $this->location,
            'size' => $this->size,
            'number_of_trees' => $this->plants->count(),
            'blueprint' => $this->blueprint ? Storage::disk('blueprints')->url($this->blueprint) : '',
        ];
    }
}
