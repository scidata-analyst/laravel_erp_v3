<?php

namespace App\Services\QualityControl;

use App\Interfaces\QualityControl\DefectsInterface;
use App\DTOs\QualityControl\DefectsDTO;
use App\Models\QualityControl\Defects;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DefectsService
{
    public function __construct(
        protected DefectsInterface $repository
    ) {}

    public function getDefects(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function reportDefect(DefectsDTO $dto): Defects
    {
        return $this->repository->create($dto->toArray());
    }

    public function getDefectById(int $id): ?Defects
    {
        return $this->repository->read($id);
    }

    public function resolveDefect(int $id, string $resolution): bool
    {
        return $this->repository->resolve($id, $resolution);
    }

    public function updateDefect(int $id, DefectsDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteDefect(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
