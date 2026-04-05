<?php

namespace App\Services\Core;

use App\Interfaces\Core\DashboardInterface;
use App\DTOs\Core\DashboardDTO;
use App\Models\Core\Dashboard;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
    public function __construct(
        protected DashboardInterface $repository
    ) {}

    public function getMetrics(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function logMetric(DashboardDTO $dto): Dashboard
    {
        return $this->repository->create($dto->toArray());
    }

    public function getLatestStats(): Collection
    {
        return $this->repository->getLatestMetrics();
    }

    public function getStatsByCategory(string $category): Collection
    {
        return $this->repository->getByCategory($category);
    }
}
