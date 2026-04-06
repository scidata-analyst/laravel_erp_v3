<?php

namespace App\DTOs\UsersRoles;

class RolesDTO
{
    public readonly string $role_name;
    public readonly ?string $description;
    public readonly array $permissions;
    public readonly ?bool $is_system_role;
    public readonly ?bool $is_active;
    public readonly ?int $created_by;

    public function __construct(array $data)
    {
        $this->role_name = $data['role_name'] ?? $data['name'] ?? '';
        $this->description = $data['description'] ?? null;
        $this->permissions = $data['permissions'] ?? [];
        $this->is_system_role = isset($data['is_system_role']) ? (bool) $data['is_system_role'] : null;
        $this->is_active = isset($data['is_active']) ? (bool) $data['is_active'] : true;
        $this->created_by = isset($data['created_by']) ? (int) $data['created_by'] : null;
    }
}