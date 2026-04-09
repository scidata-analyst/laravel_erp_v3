<?php

namespace App\DTOs\Sales;

use App\Models\Sales\SalesOrders;

class SalesOrdersDTO
{
    public ?int $id;

    public ?int $customerId;

    public ?string $orderNumber;

    public ?string $orderDate;

    public ?string $deliveryDate;

    public ?string $paymentTerms;

    public ?float $discountPercentage;

    public ?float $totalAmount;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?CustomersDTO $customer;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->customerId = isset($data['customer_id']) ? (int) $data['customer_id'] : null;
        $this->orderNumber = $data['order_number'] ?? null;
        $this->orderDate = $data['order_date'] ?? null;
        $this->deliveryDate = $data['delivery_date'] ?? null;
        $this->paymentTerms = $data['payment_terms'] ?? null;
        $this->discountPercentage = isset($data['discount_percentage']) ? (float) $data['discount_percentage'] : null;
        $this->totalAmount = isset($data['total_amount']) ? (float) $data['total_amount'] : null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->customer = $data['customer'] ?? null;
    }

    public static function fromModel(SalesOrders $model): self
    {
        $data = [
            'id' => $model->id,
            'customer_id' => $model->customer_id,
            'order_number' => $model->order_number,
            'order_date' => $model->order_date,
            'delivery_date' => $model->delivery_date,
            'payment_terms' => $model->payment_terms,
            'discount_percentage' => $model->discount_percentage,
            'total_amount' => $model->total_amount,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('customer')) {
            $data['customer'] = CustomersDTO::fromModel($model->customer);
        }

        return new self($data);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customerId,
            'order_number' => $this->orderNumber,
            'order_date' => $this->orderDate,
            'delivery_date' => $this->deliveryDate,
            'payment_terms' => $this->paymentTerms,
            'discount_percentage' => $this->discountPercentage,
            'total_amount' => $this->totalAmount,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'customer_id' => $this->customerId,
            'order_number' => $this->orderNumber,
            'order_date' => $this->orderDate,
            'delivery_date' => $this->deliveryDate,
            'payment_terms' => $this->paymentTerms,
            'discount_percentage' => $this->discountPercentage,
            'total_amount' => $this->totalAmount,
            'status' => $this->status,
        ];
    }
}
