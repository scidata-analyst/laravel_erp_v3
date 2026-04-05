<?php

namespace App\Services\QualityControl;

use App\Interfaces\QualityControl\QcChecklistsInterface;
use App\DTOs\QualityControl\QcChecklistsDTO;
use App\Models\QualityControl\QcChecklists;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class QcChecklistsService
{
    public function __construct(
        protected QcChecklistsInterface $repository
    ) {}

    public function getChecklists(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createChecklist(QcChecklistsDTO $dto): QcChecklists
    {
        return $this->repository->create($dto->toArray());
    }

    public function getChecklistById(int $id): ?QcChecklists
    {
        return $this->repository->read($id);
    }

    public function updateChecklist(int $id, QcChecklistsDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteChecklist(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function getChecklistsByCategory(string $category): Collection
    {
        return $this->repository->getByCategory($category);
    }
}
