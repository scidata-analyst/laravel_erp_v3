<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'department_id' => $this->department_id,
            'role' => $this->role ? $this->role->role_name : null,
            'department' => $this->department ? $this->department->department_name : null,
            'status' => $this->status,
            'last_login_at' => $this->last_login_at ? $this->last_login_at->toDateTimeString() : null,
            'last_login' => $this->last_login_at ? $this->last_login_at->toDateTimeString() : null,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
