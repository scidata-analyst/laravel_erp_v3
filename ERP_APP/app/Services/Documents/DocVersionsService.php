<?php

namespace App\Services\Documents;

use App\Interfaces\Documents\DocVersionsInterface;
use App\DTOs\Documents\DocVersionsDTO;
use App\Models\Documents\DocVersions;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DocVersionsService
{
    public function __construct(
        protected DocVersionsInterface $repository
    ) {}

    public function getVersions(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createVersion(DocVersionsDTO $dto): DocVersions
    {
        return $this->repository->create($dto->toArray());
    }

    public function getVersionById(int $id): ?DocVersions
    {
        return $this->repository->read($id);
    }

    public function getVersionsByDocumentId(int $documentId): Collection
    {
        return $this->repository->getByDocument($documentId);
    }

    public function updateVersion(int $id, DocVersionsDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteVersion(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
