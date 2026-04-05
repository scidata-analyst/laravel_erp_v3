<?php

namespace App\Services\Logistics;

use App\Interfaces\Logistics\WarehousesInterface;
use App\DTOs\Logistics\WarehousesDTO;
use App\Models\Logistics\Warehouses;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class WarehousesService
{
    public function __construct(
        protected WarehousesInterface $repository
    ) {}

    public function getWarehouses(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createWarehouse(WarehousesDTO $dto): Warehouses
    {
        return $this->repository->create($dto->toArray());
    }

    public function getWarehouseById(int $id): ?Warehouses
    {
        return $this->repository->read($id);
    }

    public function updateWarehouse(int $id, WarehousesDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteWarehouse(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function getWarehousesForManager(int $managerId): Collection
    {
        return $this->repository->getByManager($managerId);
    }
}
