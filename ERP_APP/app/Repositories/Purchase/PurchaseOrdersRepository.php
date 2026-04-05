<?php

namespace App\Repositories\Purchase;

use App\Interfaces\Purchase\PurchaseOrdersInterface;
use App\Models\Purchase\PurchaseOrders;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PurchaseOrdersRepository implements PurchaseOrdersInterface
{
    public function all(): Collection
    {
        return PurchaseOrders::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return PurchaseOrders::with(['supplier'])->paginate($perPage);
    }

    public function create(array $data): PurchaseOrders
    {
        return PurchaseOrders::create($data);
    }

    public function read(int $id): ?PurchaseOrders
    {
        return PurchaseOrders::with(['supplier'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $order = $this->read($id);
        return $order ? $order->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $order = $this->read($id);
        return $order ? $order->delete() : false;
    }

    public function getBySupplier(int $supplierId): Collection
    {
        return PurchaseOrders::where('supplier_id', $supplierId)->get();
    }

    public function updateStatus(int $id, string $status): bool
    {
        $order = $this->read($id);
        if ($order) {
            $order->status = $status;
            return $order->save();
        }
        return false;
    }
}