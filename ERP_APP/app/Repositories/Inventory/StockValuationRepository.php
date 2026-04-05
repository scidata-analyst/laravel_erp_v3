<?php

namespace App\Repositories\Inventory;

use App\Interfaces\Inventory\StockValuationInterface;
use App\Models\Inventory\StockValuation;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class StockValuationRepository implements StockValuationInterface
{
    public function all(): Collection
    {
        return StockValuation::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return StockValuation::with(['product'])->paginate($perPage);
    }

    public function create(array $data): StockValuation
    {
        return StockValuation::create($data);
    }

    public function read(int $id): ?StockValuation
    {
        return StockValuation::with(['product'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $valuation = $this->read($id);
        return $valuation ? $valuation->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $valuation = $this->read($id);
        return $valuation ? $valuation->delete() : false;
    }

    public function getLatestByProduct(int $productId): ?StockValuation
    {
        return StockValuation::where('product_id', $productId)->latest('valuation_date')->first();
    }
}