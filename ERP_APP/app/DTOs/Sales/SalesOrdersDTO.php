<?php

namespace App\DTOs\Sales;

use App\Models\Sales\SalesOrders;

/**
 * Data Transfer Object for SalesOrders entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates sales order data.
 *
 * @property int|null $id
 * @property int|null $customerId
 * @property string|null $orderNumber
 * @property string|null $orderDate
 * @property string|null $deliveryDate
 * @property string|null $paymentTerms
 * @property float|null $discountPercentage
 * @property float|null $totalAmount
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property CustomersDTO|null $customer
 */
class SalesOrdersDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to customers table */
    public ?int $customerId;

    /** @var string|null Unique order number (e.g., 'SO-2024-0001') */
    public ?string $orderNumber;

    /** @var string|null Date order was placed (Y-m-d) */
    public ?string $orderDate;

    /** @var string|null Expected delivery date (Y-m-d) */
    public ?string $deliveryDate;

    /** @var string|null Payment terms (e.g., 'Net 30', 'Net 60') */
    public ?string $paymentTerms;

    /** @var float|null Discount percentage (0-100) */
    public ?float $discountPercentage;

    /** @var float|null Total order amount after discount */
    public ?float $totalAmount;

    /** @var int|null Status: 0=Pending, 1=Confirmed, 2=Processing, 3=Shipped, 4=Delivered, 5=Cancelled */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var CustomersDTO|null Related customer */
    public ?CustomersDTO $customer;

    /**
     * Create a new SalesOrdersDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param SalesOrders $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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
