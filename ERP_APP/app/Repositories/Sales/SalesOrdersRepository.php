<?php

namespace App\Repositories\Sales;

use App\Interfaces\Sales\SalesOrdersInterface;
use App\Models\Sales\SalesOrders;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SalesOrdersRepository implements SalesOrdersInterface
{
    public function all(): Collection
    {
        return SalesOrders::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return SalesOrders::with(['customer', 'invoices'])->paginate($perPage);
    }

    public function create(array $data): SalesOrders
    {
        return SalesOrders::create($data);
    }

    public function read(int $id): ?SalesOrders
    {
        return SalesOrders::with(['customer', 'invoices'])->find($id);
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

    public function getByCustomer(int $customerId): Collection
    {
        return SalesOrders::where('customer_id', $customerId)->get();
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
