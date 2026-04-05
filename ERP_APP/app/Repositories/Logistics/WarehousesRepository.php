<?php

namespace App\Repositories\Logistics;

use App\Interfaces\Logistics\WarehousesInterface;
use App\Models\Logistics\Warehouses;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class WarehousesRepository implements WarehousesInterface
{
    public function all(): Collection
    {
        return Warehouses::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Warehouses::with(['manager'])->paginate($perPage);
    }

    public function create(array $data): Warehouses
    {
        return Warehouses::create($data);
    }

    public function read(int $id): ?Warehouses
    {
        return Warehouses::with(['manager', 'products', 'stockMovements'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $warehouse = $this->read($id);
        return $warehouse ? $warehouse->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $warehouse = $this->read($id);
        return $warehouse ? $warehouse->delete() : false;
    }

    public function getByManager(int $managerId): Collection
    {
        return Warehouses::where('manager_id', $managerId)->get();
    }
}
