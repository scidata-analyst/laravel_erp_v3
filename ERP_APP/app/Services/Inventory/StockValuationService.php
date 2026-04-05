<?php

namespace App\Services\Inventory;

use App\Interfaces\Inventory\StockValuationInterface;
use App\DTOs\Inventory\StockValuationDTO;
use App\Models\Inventory\StockValuation;
use App\Models\Inventory\ProductCatalog;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class StockValuationService
{
    public function __construct(
        protected StockValuationInterface $repository
    ) {}

    public function getValuations(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function calculateAndRecordValuation(int $productId): StockValuation
    {
        $product = ProductCatalog::with('stockMovements')->findOrFail($productId);
        $quantityOnHand = $product->stockMovements->sum(function ($movement) {
            return match ($movement->movement_type) {
                'Stock In' => (float) $movement->quantity,
                'Stock Out' => (float) $movement->quantity * -1,
                default => 0,
            };
        });
        $quantityOnHand = max(0, $quantityOnHand);
        $unitCost = (float) ($product->cost_price ?? $product->unit_price ?? 0);
        $totalValue = $unitCost * $quantityOnHand;

        $dto = new StockValuationDTO(
            product_id: $productId,
            quantity_on_hand: $quantityOnHand,
            unit_cost: $unitCost,
            total_value: $totalValue,
            valuation_method: 'Weighted Average',
            valuation_date: now()->toDateTimeString()
        );

        return $this->repository->create($dto->toArray());
    }

    public function getValuationById(int $id): ?StockValuation
    {
        return $this->repository->read($id);
    }

    public function getLatestProductValuation(int $productId): ?StockValuation
    {
        return $this->repository->getLatestByProduct($productId);
    }
}
