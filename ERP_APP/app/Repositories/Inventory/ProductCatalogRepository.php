<?php

namespace App\Repositories\Inventory;

use App\Interfaces\Inventory\ProductCatalogInterface;
use App\Models\Inventory\ProductCatalog;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductCatalogRepository implements ProductCatalogInterface
{
    public function all(): Collection
    {
        return ProductCatalog::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return ProductCatalog::paginate($perPage);
    }

    public function create(array $data): ProductCatalog
    {
        return ProductCatalog::create($data);
    }

    public function read(int $id): ?ProductCatalog
    {
        return ProductCatalog::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $product = $this->read($id);
        return $product ? $product->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $product = $this->read($id);
        return $product ? $product->delete() : false;
    }

    public function findBySku(string $sku): ?ProductCatalog
    {
        return ProductCatalog::where('sku', $sku)->first();
    }
}