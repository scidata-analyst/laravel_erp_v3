<?php

namespace App\DTOs\UsersRoles;

use App\Models\UsersRoles\User;

/**
 * Data Transfer Object for User entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates user authentication/authorization data.
 *
 * @property int|null $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $password
 * @property string|null $createdAt
 * @property string|null $updatedAt
 */
class UserDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null User's full name */
    public ?string $name;

    /** @var string|null User's email address */
    public ?string $email;

    /** @var string|null User's password (hashed) */
    public ?string $password;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /**
     * Create a new UserDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->name = $data['name'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param User $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(User $model): self
    {
        return new self([
            'id' => $model->id,
            'name' => $model->name ?? null,
            'email' => $model->email ?? null,
            'password' => $model->password ?? null,
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
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
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
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
