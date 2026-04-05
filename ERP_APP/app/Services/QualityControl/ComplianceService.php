<?php

namespace App\Services\QualityControl;

use App\Interfaces\QualityControl\ComplianceInterface;
use App\DTOs\QualityControl\ComplianceDTO;
use App\Models\QualityControl\Compliance;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ComplianceService
{
    public function __construct(
        protected ComplianceInterface $repository
    ) {}

    public function getComplianceStandards(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function addStandard(ComplianceDTO $dto): Compliance
    {
        return $this->repository->create($dto->toArray());
    }

    public function getStandardsByCategory(string $category): Collection
    {
        return $this->repository->getByCategory($category);
    }

    public function getActiveComplianceItems(): Collection
    {
        return $this->repository->getActiveStandards();
    }

    public function getStandardById(int $id): ?Compliance
    {
        return $this->repository->read($id);
    }

    public function updateStandard(int $id, ComplianceDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteStandard(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
