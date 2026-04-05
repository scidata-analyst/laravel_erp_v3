<?php

namespace App\DTOs\UsersRoles;

class UsersDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $password = null,
        public readonly ?int $role_id = null,
        public readonly ?int $department_id = null,
        public readonly ?string $status = null,
        public readonly ?string $last_login_at = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'] ?? null,
            role_id: isset($data['role_id']) ? (int) $data['role_id'] : null,
            department_id: isset($data['department_id']) ? (int) $data['department_id'] : null,
            status: $data['status'] ?? null,
            last_login_at: $data['last_login_at'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role_id' => $this->role_id,
            'department_id' => $this->department_id,
            'status' => $this->status,
            'last_login_at' => $this->last_login_at,
        ];
    }
}
