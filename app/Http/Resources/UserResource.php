<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $roleData = [
            'id' => '',
            'name' => '',
        ];
        if (count($this->roles)) {
            $roleData = [
                'id' => $this->roles[0]->id,
                'name' => $this->roles[0]->name,
            ];
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'dni' => $this->dni,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'avatar' => $this->avatar ? Storage::disk('avatars')->url($this->avatar) : '',
            'role' => $roleData,
        ];
    }
}
