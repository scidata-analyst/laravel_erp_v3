<?php

namespace App\DTOs\UsersRoles;

use App\Models\UsersRoles\Roles;

class RolesDTO
{
    public ?int $id;

    public ?string $roleName;

    public ?string $description;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->roleName = $data['role_name'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    public static function fromModel(Roles $model): self
    {
        return new self([
            'id' => $model->id,
            'role_name' => $model->role_name,
            'description' => $model->description,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ]);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'role_name' => $this->roleName,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'role_name' => $this->roleName,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
