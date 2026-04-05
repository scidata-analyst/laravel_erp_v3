<?php

namespace App\Services\Inventory;

use App\Interfaces\Inventory\ProductCatalogInterface;
use App\DTOs\Inventory\ProductCatalogDTO;
use App\Models\Inventory\ProductCatalog;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductCatalogService
{
    public function __construct(
        protected ProductCatalogInterface $repository
    ) {}

    public function getAllProducts(): Collection
    {
        return $this->repository->all();
    }

    public function getPaginatedProducts(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createProduct(ProductCatalogDTO $dto): ProductCatalog
    {
        return $this->repository->create($dto->toArray());
    }

    public function getProductById(int $id): ?ProductCatalog
    {
        return $this->repository->read($id);
    }

    public function updateProduct(int $id, ProductCatalogDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteProduct(int $id): bool
    {
        $product = $this->repository->read($id);
        
        if (!$product) {
            throw new \Exception('Product not found');
        }

        // Business Logic: Check constraints before deletion
        if ($product->stockMovements()->count() > 0) {
            throw new \Exception('Cannot delete product with existing stock movements');
        }

        if ($product->batchTracking()->count() > 0) {
            throw new \Exception('Cannot delete product with existing batch records');
        }

        return $this->repository->delete($id);
    }

    public function getLowStockProducts(): Collection
    {
        return ProductCatalog::with(['stockMovements', 'warehouseLocation'])
            ->get()
            ->filter(function (ProductCatalog $product) {
                $stock = $product->stockMovements->sum(function ($movement) {
                    return match ($movement->movement_type) {
                        'Stock In' => (int) $movement->quantity,
                        'Stock Out' => (int) $movement->quantity * -1,
                        default => 0,
                    };
                });

                return $stock <= (int) ($product->reorder_level ?? 0);
            })
            ->sortBy('product_name')
            ->values();
    }

    public function getProductStats(): array
    {
        $products = ProductCatalog::with('stockMovements')->get();
        $totalProducts = $products->count();
        $totalValue = $products->sum('unit_price');
        $totalCost = $products->sum('cost_price');
        $totalProfit = $totalValue - $totalCost;
        $lowStockCount = $products->filter(function (ProductCatalog $product) {
            $stock = $product->stockMovements->sum(function ($movement) {
                return match ($movement->movement_type) {
                    'Stock In' => (int) $movement->quantity,
                    'Stock Out' => (int) $movement->quantity * -1,
                    default => 0,
                };
            });

            return $stock <= (int) ($product->reorder_level ?? 0);
        })->count();

        return [
            'total_products' => $totalProducts,
            'active_products' => $products->where('status', 'active')->count(),
            'inactive_products' => $products->where('status', 'inactive')->count(),
            'discontinued_products' => $products->where('status', 'discontinued')->count(),
            'low_stock_count' => $lowStockCount,
            'total_value' => $totalValue,
            'total_cost' => $totalCost,
            'total_profit' => $totalProfit,
            'profit_margin' => $totalValue > 0 ? ($totalProfit / $totalValue) * 100 : 0
        ];
    }
}
