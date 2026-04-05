<?php

namespace App\Services\Sales;

use App\Interfaces\Sales\SalesOrdersInterface;
use App\DTOs\Sales\SalesOrdersDTO;
use App\Models\Sales\SalesOrders;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class SalesOrdersService
{
    public function __construct(
        protected SalesOrdersInterface $repository
    ) {}

    public function getOrders(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createOrder(SalesOrdersDTO $dto): SalesOrders
    {
        return $this->repository->create($this->prepareOrderData($dto->toArray()));
    }

    public function getOrderById(int $id): ?SalesOrders
    {
        return $this->repository->read($id);
    }

    public function updateOrderStatus(int $id, string $status): bool
    {
        return $this->repository->updateStatus($id, $this->normalizeStatus($status));
    }

    public function cancelOrder(int $id): bool
    {
        $order = $this->repository->read($id);
        if (!$order) {
            throw new \Exception('Order not found');
        }

        if ($order->status === 'shipped' || $order->status === 'delivered') {
            throw new \Exception('Cannot cancel order that has been shipped or delivered');
        }

        return $this->repository->updateStatus($id, 'cancelled');
    }

    public function updateOrder(int $id, SalesOrdersDTO $dto): bool
    {
        $order = $this->repository->read($id);

        if (!$order) {
            return false;
        }

        return $this->repository->update($id, $this->prepareOrderData($dto->toArray(), $order));
    }

    public function deleteOrder(int $id): bool
    {
        $order = $this->repository->read($id);

        if (!$order) {
            return false;
        }

        if ($order->invoices()->exists()) {
            throw new \Exception('Cannot delete an order that already has invoices');
        }

        return $this->repository->delete($id);
    }

    protected function prepareOrderData(array $data, ?SalesOrders $existing = null): array
    {
        $items = $data['order_items'] ?? [];

        if (!is_array($items)) {
            $items = [];
        }

        $discount = (float) ($data['discount'] ?? $existing?->discount ?? 0);
        $totalAmount = (float) ($data['total_amount'] ?? 0);

        if ($totalAmount <= 0 && $items) {
            $totalAmount = collect($items)->sum(function ($item) {
                $qty = (float) ($item['qty'] ?? $item['quantity'] ?? 0);
                $price = (float) ($item['unit_price'] ?? 0);
                $lineDiscount = (float) ($item['discount'] ?? 0);

                return max(0, ($qty * $price) - $lineDiscount);
            });
        }

        return [
            'so_number' => $data['so_number'] ?? $existing?->so_number ?? $this->generateOrderNumber(),
            'customer_id' => $data['customer_id'],
            'order_date' => $data['order_date'],
            'delivery_date' => $data['delivery_date'] ?? $existing?->delivery_date,
            'payment_terms' => $data['payment_terms'] ?? $existing?->payment_terms ?? 'Net 30',
            'discount' => $discount,
            'total_amount' => $totalAmount,
            'status' => $this->normalizeStatus($data['status'] ?? $existing?->status ?? 'draft'),
            'order_items' => $items,
            'notes' => $data['notes'] ?? $existing?->notes,
        ];
    }

    protected function generateOrderNumber(): string
    {
        do {
            $number = 'SO-' . now()->format('Ymd') . '-' . Str::upper(Str::random(4));
        } while (SalesOrders::where('so_number', $number)->exists());

        return $number;
    }

    protected function normalizeStatus(?string $status): string
    {
        return match (strtolower((string) $status)) {
            'pending' => 'draft',
            'dispatched' => 'shipped',
            default => strtolower((string) ($status ?: 'draft')),
        };
    }
}
