<?php

namespace App\Http\Resources\UsersRoles;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RolesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'role_name' => $this->role_name,
            'description' => $this->description,
            'permissions' => $this->permissions,
            'is_system_role' => $this->is_system_role,
            'is_active' => $this->is_active,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
