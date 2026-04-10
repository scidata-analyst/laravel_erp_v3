<?php

namespace App\DTOs\Sales;

use App\Models\Sales\Invoices;

/**
 * Data Transfer Object for Invoices entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates invoice/billing data.
 *
 * @property int|null $id
 * @property int|null $customerId
 * @property string|null $invoiceNumber
 * @property string|null $salesOrderRef
 * @property string|null $invoiceDate
 * @property string|null $dueDate
 * @property float|null $amount
 * @property float|null $taxPercentage
 * @property string|null $notes
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property CustomersDTO|null $customer
 */
class InvoicesDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to customers table */
    public ?int $customerId;

    /** @var string|null Unique invoice number (e.g., 'INV-2024-0001') */
    public ?string $invoiceNumber;

    /** @var string|null Reference to related sales order */
    public ?string $salesOrderRef;

    /** @var string|null Date invoice was issued (Y-m-d) */
    public ?string $invoiceDate;

    /** @var string|null Payment due date (Y-m-d) */
    public ?string $dueDate;

    /** @var float|null Total invoice amount before tax */
    public ?float $amount;

    /** @var float|null Tax percentage applied (0-100) */
    public ?float $taxPercentage;

    /** @var string|null Additional notes or terms */
    public ?string $notes;

    /** @var int|null Status: 0=Draft, 1=Issued, 2=Paid, 3=Overdue, 4=Cancelled */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var CustomersDTO|null Related customer */
    public ?CustomersDTO $customer;

    /**
     * Create a new InvoicesDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->customerId = isset($data['customer_id']) ? (int) $data['customer_id'] : null;
        $this->invoiceNumber = $data['invoice_number'] ?? null;
        $this->salesOrderRef = $data['sales_order_ref'] ?? null;
        $this->invoiceDate = $data['invoice_date'] ?? null;
        $this->dueDate = $data['due_date'] ?? null;
        $this->amount = isset($data['amount']) ? (float) $data['amount'] : null;
        $this->taxPercentage = isset($data['tax_percentage']) ? (float) $data['tax_percentage'] : null;
        $this->notes = $data['notes'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->customer = $data['customer'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Invoices $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(Invoices $model): self
    {
        $data = [
            'id' => $model->id,
            'customer_id' => $model->customer_id,
            'invoice_number' => $model->invoice_number,
            'sales_order_ref' => $model->sales_order_ref,
            'invoice_date' => $model->invoice_date,
            'due_date' => $model->due_date,
            'amount' => $model->amount,
            'tax_percentage' => $model->tax_percentage,
            'notes' => $model->notes,
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
            'invoice_number' => $this->invoiceNumber,
            'sales_order_ref' => $this->salesOrderRef,
            'invoice_date' => $this->invoiceDate,
            'due_date' => $this->dueDate,
            'amount' => $this->amount,
            'tax_percentage' => $this->taxPercentage,
            'notes' => $this->notes,
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
            'invoice_number' => $this->invoiceNumber,
            'sales_order_ref' => $this->salesOrderRef,
            'invoice_date' => $this->invoiceDate,
            'due_date' => $this->dueDate,
            'amount' => $this->amount,
            'tax_percentage' => $this->taxPercentage,
            'notes' => $this->notes,
            'status' => $this->status,
        ];
    }
}
