<?php

namespace App\DTOs\Purchase;

use App\Models\Purchase\SupplierPayments;

class SupplierPaymentsDTO
{
    public ?int $id;

    public ?int $supplierId;

    public ?string $paymentNumber;

    public ?string $invoiceReference;

    public ?float $amount;

    public ?string $paymentDate;

    public ?string $paymentMethod;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?SuppliersDTO $supplier;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
