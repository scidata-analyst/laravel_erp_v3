<?php

namespace App\Services\Reports;

use App\Interfaces\Reports\BiWidgetsInterface;
use App\DTOs\Reports\BiWidgetsDTO;
use App\Models\Reports\BiWidgets;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BiWidgetsService
{
    public function __construct(
        protected BiWidgetsInterface $repository
    ) {}

    public function getWidgets(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createWidget(BiWidgetsDTO $dto): BiWidgets
    {
        return $this->repository->create($dto->toArray());
    }

    public function getWidgetById(int $id): ?BiWidgets
    {
        return $this->repository->read($id);
    }

    public function getWidgetsForDashboard(int $dashboardId): Collection
    {
        return $this->repository->getByDashboard($dashboardId);
    }
}
