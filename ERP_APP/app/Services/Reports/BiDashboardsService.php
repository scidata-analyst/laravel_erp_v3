<?php

namespace App\Services\Reports;

use App\Interfaces\Reports\BiDashboardsInterface;
use App\DTOs\Reports\BiDashboardsDTO;
use App\Models\Reports\BiDashboards;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BiDashboardsService
{
    public function __construct(
        protected BiDashboardsInterface $repository
    ) {}

    public function getDashboards(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createDashboard(BiDashboardsDTO $dto): BiDashboards
    {
        return $this->repository->create($dto->toArray());
    }

    public function getDashboardById(int $id): ?BiDashboards
    {
        return $this->repository->read($id);
    }

    public function updateDashboard(int $id, BiDashboardsDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteDashboard(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function getDashboardsForUser(int $userId): Collection
    {
        return $this->repository->getUserDashboards($userId);
    }
}
