<?php

namespace App\Services\Production;

use App\Interfaces\Production\MachineLaborInterface;
use App\DTOs\Production\MachineLaborDTO;
use App\Models\Production\MachineLabor;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class MachineLaborService
{
    public function __construct(
        protected MachineLaborInterface $repository
    ) {}

    public function getResourceUsage(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function recordUsage(MachineLaborDTO $dto): MachineLabor
    {
        return $this->repository->create($dto->toArray());
    }

    public function getUsageByWorkOrder(int $workOrderId): Collection
    {
        return $this->repository->getByWorkOrder($workOrderId);
    }

    public function getUsageById(int $id): ?MachineLabor
    {
        return $this->repository->read($id);
    }

    public function updateUsage(int $id, MachineLaborDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteUsage(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function calculateTotalCost(int $workOrderId): float
    {
        $usage = $this->repository->getByWorkOrder($workOrderId);
        return $usage->sum(function ($item) {
            return $item->hours_spent * ($item->hourly_rate ?? 0);
        });
    }
}
