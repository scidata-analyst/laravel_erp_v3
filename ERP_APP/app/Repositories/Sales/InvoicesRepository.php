<?php

namespace App\Repositories\Sales;

use App\Interfaces\Sales\InvoicesInterface;
use App\Models\Sales\Invoices;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class InvoicesRepository implements InvoicesInterface
{
    public function all(): Collection
    {
        return Invoices::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Invoices::with(['customer', 'salesOrder.customer', 'generatedBy'])->paginate($perPage);
    }

    public function create(array $data): Invoices
    {
        return Invoices::create($data);
    }

    public function read(int $id): ?Invoices
    {
        return Invoices::with(['customer', 'salesOrder.customer', 'generatedBy'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $invoice = $this->read($id);
        return $invoice ? $invoice->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $invoice = $this->read($id);
        return $invoice ? $invoice->delete() : false;
    }

    public function getByOrder(int $orderId): Collection
    {
        return Invoices::where('sales_order_id', $orderId)->get();
    }

    public function updatePaymentStatus(int $id, string $status): bool
    {
        $invoice = $this->read($id);
        if ($invoice) {
            $invoice->status = $status;
            return $invoice->save();
        }
        return false;
    }
}
