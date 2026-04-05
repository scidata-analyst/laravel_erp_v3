<?php

namespace App\DTOs\UsersRoles;

class RolesDTO
{
    public function __construct(
        public readonly string $role_name,
        public readonly ?string $description = null,
        public readonly array $permissions = [],
        public readonly ?bool $is_system_role = null,
        public readonly ?bool $is_active = true,
        public readonly ?int $created_by = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            role_name: $data['role_name'] ?? $data['name'],
            description: $data['description'] ?? null,
            permissions: $data['permissions'] ?? [],
            is_system_role: isset($data['is_system_role']) ? (bool) $data['is_system_role'] : null,
            is_active: isset($data['is_active']) ? (bool) $data['is_active'] : true,
            created_by: isset($data['created_by']) ? (int) $data['created_by'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'role_name' => $this->role_name,
            'description' => $this->description,
            'permissions' => $this->permissions,
            'is_system_role' => $this->is_system_role,
            'is_active' => $this->is_active,
            'created_by' => $this->created_by,
        ];
    }
}
