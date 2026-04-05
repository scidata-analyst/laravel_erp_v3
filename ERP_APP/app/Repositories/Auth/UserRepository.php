<?php

namespace App\Repositories\Auth;

use App\Interfaces\Auth\UserInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserInterface
{
    public function all(): Collection
    {
        return User::all();
    }

    public function index(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        $query = User::with(['role', 'department']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if (!empty($filters)) {
            foreach ($filters as $filter) {
                if (isset($filter['field']) && isset($filter['value'])) {
                    $query->where($filter['field'], $filter['value']);
                }
            }
        }

        return $query->paginate($perPage);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function read(int $id): ?User
    {
        return User::with(['role', 'department'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $user = $this->read($id);
        return $user ? $user->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $user = $this->read($id);
        return $user ? $user->delete() : false;
    }

    public function getByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function getByRole(int $roleId): Collection
    {
        return User::where('role_id', $roleId)->get();
    }
}
