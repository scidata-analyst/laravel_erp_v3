<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RolesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'role_name' => $this->role_name,
            'name' => $this->role_name,
            'description' => $this->description,
            'permissions' => $this->permissions,
            'status' => $this->is_active ? 'active' : 'inactive',
            'is_system_role' => $this->is_system_role,
            'is_active' => $this->is_active,
            'user_count' => $this->whenCounted('users', $this->users_count),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
