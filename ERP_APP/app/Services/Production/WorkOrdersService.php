<?php

namespace App\Services\Production;

use App\Interfaces\Production\WorkOrdersInterface;
use App\DTOs\Production\WorkOrdersDTO;
use App\Models\Production\WorkOrders;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class WorkOrdersService
{
    public function __construct(
        protected WorkOrdersInterface $repository
    ) {}

    public function getWorkOrders(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createWorkOrder(WorkOrdersDTO $dto): WorkOrders
    {
        return $this->repository->create($dto->toArray());
    }

    public function getWorkOrderById(int $id): ?WorkOrders
    {
        return $this->repository->read($id);
    }

    public function updateWorkOrderProgress(int $id, int $producedQty, int $scrapQty): bool
    {
        return $this->repository->updateProgress($id, $producedQty, $scrapQty);
    }

    public function getWorkOrdersByStatus(string $status): Collection
    {
        return $this->repository->getByStatus($status);
    }

    public function updateWorkOrder(int $id, WorkOrdersDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteWorkOrder(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
