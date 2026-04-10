<?php

namespace App\DTOs\Purchase;

use App\Models\Purchase\SupplierPayments;

/**
 * Data Transfer Object for SupplierPayments entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates supplier payment data.
 *
 * @property int|null $id
 * @property int|null $supplierId
 * @property string|null $paymentNumber
 * @property string|null $invoiceReference
 * @property float|null $amount
 * @property string|null $paymentDate
 * @property string|null $paymentMethod
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property SuppliersDTO|null $supplier
 */
class SupplierPaymentsDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to suppliers table */
    public ?int $supplierId;

    /** @var string|null Payment reference number (e.g., 'PAY-2024-0001') */
    public ?string $paymentNumber;

    /** @var string|null Reference to supplier invoice */
    public ?string $invoiceReference;

    /** @var float|null Payment amount */
    public ?float $amount;

    /** @var string|null Date of payment (Y-m-d) */
    public ?string $paymentDate;

    /** @var string|null Payment method (e.g., 'Bank Transfer', 'Cheque', 'Cash') */
    public ?string $paymentMethod;

    /** @var int|null Status: 0=Pending, 1=Processing, 2=Completed, 3=Failed */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var SuppliersDTO|null Related supplier */
    public ?SuppliersDTO $supplier;

    /**
     * Create a new SupplierPaymentsDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->supplierId = isset($data['supplier_id']) ? (int) $data['supplier_id'] : null;
        $this->paymentNumber = $data['payment_number'] ?? null;
        $this->invoiceReference = $data['invoice_reference'] ?? null;
        $this->amount = isset($data['amount']) ? (float) $data['amount'] : null;
        $this->paymentDate = $data['payment_date'] ?? null;
        $this->paymentMethod = $data['payment_method'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->supplier = $data['supplier'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param SupplierPayments $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(SupplierPayments $model): self
    {
        $data = [
            'id' => $model->id,
            'supplier_id' => $model->supplier_id,
            'payment_number' => $model->payment_number,
            'invoice_reference' => $model->invoice_reference,
            'amount' => $model->amount,
            'payment_date' => $model->payment_date,
            'payment_method' => $model->payment_method,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('supplier')) {
            $data['supplier'] = SuppliersDTO::fromModel($model->supplier);
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
            'supplier_id' => $this->supplierId,
            'payment_number' => $this->paymentNumber,
            'invoice_reference' => $this->invoiceReference,
            'amount' => $this->amount,
            'payment_date' => $this->paymentDate,
            'payment_method' => $this->paymentMethod,
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
            'supplier_id' => $this->supplierId,
            'payment_number' => $this->paymentNumber,
            'invoice_reference' => $this->invoiceReference,
            'amount' => $this->amount,
            'payment_date' => $this->paymentDate,
            'payment_method' => $this->paymentMethod,
            'status' => $this->status,
        ];
    }
}
