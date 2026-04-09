<?php

namespace App\DTOs\Sales;

use App\Models\Sales\Invoices;

class InvoicesDTO
{
    public ?int $id;

    public ?int $customerId;

    public ?string $invoiceNumber;

    public ?string $salesOrderRef;

    public ?string $invoiceDate;

    public ?string $dueDate;

    public ?float $amount;

    public ?float $taxPercentage;

    public ?string $notes;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?CustomersDTO $customer;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
