<?php

namespace App\DTOs\Logistics;

use App\DTOs\Sales\SalesOrdersDTO;
use App\Models\Logistics\Shipments;

/**
 * Data Transfer Object for Shipments entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates shipment/delivery data.
 *
 * @property int|null $id
 * @property int|null $salesOrderId
 * @property string|null $carrier
 * @property string|null $trackingNumber
 * @property string|null $estimatedDeliveryDate
 * @property string|null $shippingAddress
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property SalesOrdersDTO|null $salesOrder
 */
class ShipmentsDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to sales_orders table */
    public ?int $salesOrderId;

    /** @var string|null Shipping carrier name (e.g., 'DHL', 'FedEx', 'UPS') */
    public ?string $carrier;

    /** @var string|null Tracking number for shipment */
    public ?string $trackingNumber;

    /** @var string|null Estimated delivery date (Y-m-d) */
    public ?string $estimatedDeliveryDate;

    /** @var string|null Delivery address */
    public ?string $shippingAddress;

    /** @var int|null Status: 0=Pending, 1=Shipped, 2=InTransit, 3=OutForDelivery, 4=Delivered, 5=Failed */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var SalesOrdersDTO|null Related sales order */
    public ?SalesOrdersDTO $salesOrder;

    /**
     * Create a new ShipmentsDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Shipments $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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

    /**
     * Create DTO from plain array data.
     *
     * @param array $data Associative array with DTO properties
     * @return self New DTO instance
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Convert DTO to array representation.
     *
     * @return array Array with snake_case keys matching database columns
     */
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

    /**
     * Convert DTO to array for Eloquent model creation/update.
     *
     * Returns fillable attributes only, excluding timestamps
     * and foreign keys for related models.
     *
     * @return array Associative array for model mass assignment
     */
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
