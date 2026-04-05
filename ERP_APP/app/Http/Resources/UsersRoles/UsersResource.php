<?php

namespace App\Http\Resources\UsersRoles;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'department_id' => $this->department_id,
            'status' => $this->status,
            'last_login_at' => $this->last_login_at,
            'role' => new RolesResource($this->whenLoaded('role')),
            'department' => $this->whenLoaded('department'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
