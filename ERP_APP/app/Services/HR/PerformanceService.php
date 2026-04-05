<?php

namespace App\Services\HR;

use App\Interfaces\HR\PerformanceInterface;
use App\DTOs\HR\PerformanceDTO;
use App\Models\HR\Performance;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PerformanceService
{
    public function __construct(
        protected PerformanceInterface $repository
    ) {}

    public function getPerformanceReviews(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function addReview(PerformanceDTO $dto): Performance
    {
        return $this->repository->create($dto->toArray());
    }

    public function getEmployeeReviews(int $employeeId): Collection
    {
        return $this->repository->getByEmployee($employeeId);
    }

    public function getReviewById(int $id): ?Performance
    {
        return $this->repository->read($id);
    }

    public function updateReview(int $id, PerformanceDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteReview(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
