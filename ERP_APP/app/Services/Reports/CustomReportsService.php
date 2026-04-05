<?php

namespace App\Services\Reports;

use App\Interfaces\Reports\CustomReportsInterface;
use App\DTOs\Reports\CustomReportsDTO;
use App\Models\Reports\CustomReports;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CustomReportsService
{
    public function __construct(
        protected CustomReportsInterface $repository
    ) {}

    public function getReports(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createReport(CustomReportsDTO $dto): CustomReports
    {
        return $this->repository->create($dto->toArray());
    }

    public function getReportById(int $id): ?CustomReports
    {
        return $this->repository->read($id);
    }

    public function updateReport(int $id, CustomReportsDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteReport(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function getReportsByModule(string $module): Collection
    {
        return $this->repository->getByModule($module);
    }
}
