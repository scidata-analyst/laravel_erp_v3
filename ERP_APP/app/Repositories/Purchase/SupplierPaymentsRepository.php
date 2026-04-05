<?php

namespace App\Repositories\Purchase;

use App\Interfaces\Purchase\SupplierPaymentsInterface;
use App\Models\Purchase\SupplierPayments;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SupplierPaymentsRepository implements SupplierPaymentsInterface
{
    public function all(): Collection
    {
        return SupplierPayments::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return SupplierPayments::with(['supplier', 'purchaseOrder', 'approvedBy'])->paginate($perPage);
    }

    public function create(array $data): SupplierPayments
    {
        return SupplierPayments::create($data);
    }

    public function read(int $id): ?SupplierPayments
    {
        return SupplierPayments::with(['supplier', 'purchaseOrder', 'approvedBy'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $payment = $this->read($id);
        return $payment ? $payment->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $payment = $this->read($id);
        return $payment ? $payment->delete() : false;
    }

    public function getBySupplier(int $supplierId): Collection
    {
        return SupplierPayments::where('supplier_id', $supplierId)->get();
    }

    public function getByOrder(int $orderId): Collection
    {
        return SupplierPayments::where('purchase_order_id', $orderId)->get();
    }
}
