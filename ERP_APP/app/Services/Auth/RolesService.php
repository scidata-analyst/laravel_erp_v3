<?php

namespace App\Services\Auth;

use App\Services\BaseService;
use App\Interfaces\Auth\RolesInterface;
use App\DTOs\Auth\RolesDTO;
use App\Models\UsersRoles\Roles;
use Illuminate\Pagination\LengthAwarePaginator;

class RolesService extends BaseService
{
    public function __construct(
        protected RolesInterface $repository
    ) {}

    public function getRoles(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createRole(RolesDTO $dto): Roles
    {
        return $this->repository->create($dto->toArray());
    }

    public function getRoleById(int $id): ?Roles
    {
        return $this->repository->read($id);
    }

    public function updateRole(int $id, RolesDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteRole(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
