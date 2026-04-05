<?php

namespace App\Services\Projects;

use App\Interfaces\Projects\ResourcesInterface;
use App\DTOs\Projects\ResourcesDTO;
use App\Models\Projects\Resources;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ResourcesService
{
    public function __construct(
        protected ResourcesInterface $repository
    ) {}

    public function getResources(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function allocateResource(ResourcesDTO $dto): Resources
    {
        return $this->repository->create($dto->toArray());
    }

    public function getResourcesInProject(int $projectId): Collection
    {
        return $this->repository->getByProject($projectId);
    }

    public function updateAllocation(int $id, int $percentage): bool
    {
        return $this->repository->updateAllocation($id, $percentage);
    }

    public function getResourceById(int $id): ?Resources
    {
        return $this->repository->read($id);
    }

    public function updateResource(int $id, ResourcesDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteResource(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
