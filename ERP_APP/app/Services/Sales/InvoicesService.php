<?php

namespace App\Services\Sales;

use App\Interfaces\Sales\InvoicesInterface;
use App\DTOs\Sales\InvoicesDTO;
use App\Models\Sales\Invoices;
use App\Models\Sales\SalesOrders;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class InvoicesService
{
    public function __construct(
        protected InvoicesInterface $repository
    ) {}

    public function getInvoices(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function generateInvoice(InvoicesDTO $dto): Invoices
    {
        return DB::transaction(function () use ($dto) {
            $invoice = $this->repository->create($dto->toArray());

            // Business Logic: Update Sales Order Status to 'Invoiced'
            $order = SalesOrders::findOrFail($dto->sales_order_id);
            $order->status = 'invoiced';
            $order->save();

            return $invoice;
        });
    }

    public function getInvoiceById(int $id): ?Invoices
    {
        return $this->repository->read($id);
    }

    public function markAsPaid(int $id): bool
    {
        return $this->repository->updatePaymentStatus($id, 'paid');
    }

    public function getOverdueInvoices(): Collection
    {
        return Invoices::where('status', '!=', 'paid')
            ->where('due_date', '<', now())
            ->with(['salesOrder.customer'])
            ->get();
    }
}
