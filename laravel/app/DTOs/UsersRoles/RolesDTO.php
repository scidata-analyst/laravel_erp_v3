<?php

namespace App\DTOs\UsersRoles;

use App\Models\UsersRoles\Roles;

/**
 * Data Transfer Object for Roles entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates user role/permission data.
 *
 * @property int|null $id
 * @property string|null $roleName
 * @property string|null $description
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 */
class RolesDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Name of the role (e.g., 'Admin', 'Manager', 'Staff') */
    public ?string $roleName;

    /** @var string|null Description of the role */
    public ?string $description;

    /** @var int|null Status: 0=Inactive, 1=Active */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /**
     * Create a new RolesDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->roleName = $data['role_name'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Roles $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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

    /**
     * Create DTO from plain array data.
     *
     * @param array $data Associative array with DTO properties
     * @return self New DTO instance
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Convert DTO to array representation.
     *
     * @return array Array with snake_case keys matching database columns
     */
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

    /**
     * Convert DTO to array for Eloquent model creation/update.
     *
     * Returns fillable attributes only, excluding timestamps
     * and foreign keys for related models.
     *
     * @return array Associative array for model mass assignment
     */
    public function toModel(): array
    {
        return [
            'role_name' => $this->roleName,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
