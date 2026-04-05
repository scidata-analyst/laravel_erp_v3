<?php

namespace App\Services\Purchase;

use App\Interfaces\Purchase\PurchaseOrdersInterface;
use App\DTOs\Purchase\PurchaseOrdersDTO;
use App\Models\Purchase\PurchaseOrders;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class PurchaseOrdersService
{
    public function __construct(
        protected PurchaseOrdersInterface $repository
    ) {}

    public function getOrders(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createOrder(PurchaseOrdersDTO $dto): PurchaseOrders
    {
        return DB::transaction(function () use ($dto) {
            $order = $this->repository->create($dto->toArray());

            // Create Order Items (Simulating relationship, usually exists)
            // If PurchaseOrderItems model exists, we'd use it here
            
            return $order;
        });
    }

    public function getOrderById(int $id): ?PurchaseOrders
    {
        return $this->repository->read($id);
    }

    public function updateOrder(int $id, PurchaseOrdersDTO $dto): ?PurchaseOrders
    {
        $order = $this->repository->read($id);
        if (!$order) {
            return null;
        }

        $data = array_filter($dto->toArray(), function ($value) {
            return $value !== null;
        });

        if (array_key_exists('order_items', $data) && empty($data['order_items'])) {
            unset($data['order_items']);
        }

        $this->repository->update($id, $data);

        return $this->repository->read($id);
    }

    public function updateOrderStatus(int $id, string $status): bool
    {
        return $this->repository->updateStatus($id, $status);
    }

    public function receiveOrder(int $id): bool
    {
        $order = $this->repository->read($id);
        if (!$order) {
            throw new \Exception('Order not found');
        }

        if ($order->status === 'completed' || $order->status === 'cancelled') {
            throw new \Exception('Cannot receive completed or cancelled order');
        }

        return $this->repository->updateStatus($id, 'received');
    }
}
