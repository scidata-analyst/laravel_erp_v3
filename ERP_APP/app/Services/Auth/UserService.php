<?php

namespace App\Services\Auth;

use App\Services\BaseService;

use App\Interfaces\Auth\UserInterface;
use App\DTOs\Auth\UserDTO;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    public function __construct(
        protected UserInterface $repository
    ) {}

    public function getUsers(int $perPage = 15, string $search = null, array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function registerUser(UserDTO $dto): User
    {
        $data = $dto->toArray();
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->repository->create($data);
    }

    public function getUserById(int $id): ?User
    {
        return $this->repository->read($id);
    }

    public function updateUser(int $id, UserDTO $dto): bool
    {
        $data = $dto->toArray();
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->repository->update($id, $data);
    }

    public function deleteUser(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
