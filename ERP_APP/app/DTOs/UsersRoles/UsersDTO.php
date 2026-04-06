<?php

namespace App\DTOs\UsersRoles;

class UsersDTO
{
    public readonly string $name;
    public readonly string $email;
    public readonly ?string $password;
    public readonly ?int $role_id;
    public readonly ?int $department_id;
    public readonly ?string $status;
    public readonly ?string $last_login_at;

    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? null;
        $this->role_id = isset($data['role_id']) ? (int) $data['role_id'] : null;
        $this->department_id = isset($data['department_id']) ? (int) $data['department_id'] : null;
        $this->status = $data['status'] ?? null;
        $this->last_login_at = $data['last_login_at'] ?? null;
    }
}