<?php

namespace App\Services\Production;

use App\Interfaces\Production\BomInterface;
use App\DTOs\Production\BomDTO;
use App\Models\Production\Bom;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BomService
{
    public function __construct(
        protected BomInterface $repository
    ) {}

    public function getBoms(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createBom(BomDTO $dto): Bom
    {
        return $this->repository->create($dto->toArray());
    }

    public function getBomById(int $id): ?Bom
    {
        return $this->repository->read($id);
    }

    public function getActiveBomForProduct(int $productId): ?Bom
    {
        return $this->repository->getActiveByProduct($productId);
    }

    public function updateBom(int $id, BomDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteBom(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
