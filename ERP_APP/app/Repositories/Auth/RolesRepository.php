<?php

namespace App\Repositories\Auth;

use App\Interfaces\Auth\RolesInterface;
use App\Models\UsersRoles\Roles;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class RolesRepository implements RolesInterface
{
    public function all(): Collection
    {
        return Roles::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Roles::withCount('users')->paginate($perPage);
    }

    public function create(array $data): Roles
    {
        return Roles::create($data);
    }

    public function read(int $id): ?Roles
    {
        return Roles::withCount('users')->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $role = $this->read($id);
        return $role ? $role->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $role = $this->read($id);
        return $role ? $role->delete() : false;
    }

    public function getByName(string $name): ?Roles
    {
        return Roles::where('role_name', $name)->first();
    }
}
