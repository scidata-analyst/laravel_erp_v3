<?php

namespace App\Services\Inventory;

use App\Interfaces\Inventory\StockMovementsInterface;
use App\DTOs\Inventory\StockMovementsDTO;
use App\Models\Inventory\StockMovements;
use App\Models\Inventory\ProductCatalog;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class StockMovementsService
{
    public function __construct(
        protected StockMovementsInterface $repository
    ) {}

    public function getMovements(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function recordMovement(StockMovementsDTO $dto): StockMovements
    {
        ProductCatalog::findOrFail($dto->product_id);

        $data = $dto->toArray();
        $data['ref_number'] = $data['ref_number'] ?: 'SM-' . now()->format('YmdHis');
        $data['date'] = now()->toDateString();
        $data['user_id'] = $data['user_id'] ?? optional(auth()->user())->id;

        return $this->repository->create($data);
    }

    public function getMovementById(int $id): ?StockMovements
    {
        return $this->repository->read($id);
    }

    public function getProductMovements(int $productId): Collection
    {
        return $this->repository->getByProduct($productId);
    }
}
