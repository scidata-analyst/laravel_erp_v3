<?php

namespace App\Services\Documents;

use App\Interfaces\Documents\DocLibraryInterface;
use App\DTOs\Documents\DocLibraryDTO;
use App\Models\Documents\DocLibrary;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DocLibraryService
{
    public function __construct(
        protected DocLibraryInterface $repository
    ) {}

    public function getDocuments(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function uploadDocument(DocLibraryDTO $dto): DocLibrary
    {
        return $this->repository->create($dto->toArray());
    }

    public function getDocumentById(int $id): ?DocLibrary
    {
        return $this->repository->read($id);
    }

    public function getDocumentsByCategory(string $category): Collection
    {
        return $this->repository->getByCategory($category);
    }

    public function updateDocument(int $id, DocLibraryDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteDocument(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
