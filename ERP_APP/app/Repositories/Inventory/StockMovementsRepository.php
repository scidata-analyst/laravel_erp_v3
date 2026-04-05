<?php

namespace App\Repositories\Inventory;

use App\Interfaces\Inventory\StockMovementsInterface;
use App\Models\Inventory\StockMovements;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class StockMovementsRepository implements StockMovementsInterface
{
    public function all(): Collection
    {
        return StockMovements::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return StockMovements::with(['product', 'fromWarehouse', 'toWarehouse', 'user'])->paginate($perPage);
    }

    public function create(array $data): StockMovements
    {
        return StockMovements::create($data);
    }

    public function read(int $id): ?StockMovements
    {
        return StockMovements::with(['product', 'fromWarehouse', 'toWarehouse', 'user'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $movement = $this->read($id);
        return $movement ? $movement->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $movement = $this->read($id);
        return $movement ? $movement->delete() : false;
    }

    public function getByProduct(int $productId): Collection
    {
        return StockMovements::where('product_id', $productId)->with(['fromWarehouse', 'toWarehouse', 'user'])->get();
    }
}
