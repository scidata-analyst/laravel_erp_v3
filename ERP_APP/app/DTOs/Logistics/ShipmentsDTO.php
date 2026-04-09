<?php

namespace App\DTOs\Logistics;

use App\DTOs\Sales\SalesOrdersDTO;
use App\Models\Logistics\Shipments;

class ShipmentsDTO
{
    public ?int $id;

    public ?int $salesOrderId;

    public ?string $carrier;

    public ?string $trackingNumber;

    public ?string $estimatedDeliveryDate;

    public ?string $shippingAddress;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?SalesOrdersDTO $salesOrder;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->salesOrderId = isset($data['sales_order_id']) ? (int) $data['sales_order_id'] : null;
        $this->carrier = $data['carrier'] ?? null;
        $this->trackingNumber = $data['tracking_number'] ?? null;
        $this->estimatedDeliveryDate = $data['estimated_delivery_date'] ?? null;
        $this->shippingAddress = $data['shipping_address'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->salesOrder = $data['salesOrder'] ?? null;
    }

    public static function fromModel(Shipments $model): self
    {
        $data = [
            'id' => $model->id,
            'sales_order_id' => $model->sales_order_id,
            'carrier' => $model->carrier,
            'tracking_number' => $model->tracking_number,
            'estimated_delivery_date' => $model->estimated_delivery_date,
            'shipping_address' => $model->shipping_address,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('salesOrder')) {
            $data['salesOrder'] = SalesOrdersDTO::fromModel($model->salesOrder);
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
            'sales_order_id' => $this->salesOrderId,
            'carrier' => $this->carrier,
            'tracking_number' => $this->trackingNumber,
            'estimated_delivery_date' => $this->estimatedDeliveryDate,
            'shipping_address' => $this->shippingAddress,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'sales_order_id' => $this->salesOrderId,
            'carrier' => $this->carrier,
            'tracking_number' => $this->trackingNumber,
            'estimated_delivery_date' => $this->estimatedDeliveryDate,
            'shipping_address' => $this->shippingAddress,
            'status' => $this->status,
        ];
    }
}
