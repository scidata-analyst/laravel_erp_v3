<?php

namespace App\DTOs\Purchase;

use App\Models\Purchase\PurchaseOrders;
use App\Models\Purchase\Suppliers;

class SuppliersDTO
{
    public ?int $id;

    public ?string $companyName;

    public ?string $contactPerson;

    public ?string $email;

    public ?string $phone;

    public ?string $country;

    public ?string $paymentTerms;

    public ?string $currency;

    public ?string $address;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?array $purchaseOrders;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->companyName = $data['company_name'] ?? null;
        $this->contactPerson = $data['contact_person'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->country = $data['country'] ?? null;
        $this->paymentTerms = $data['payment_terms'] ?? null;
        $this->currency = $data['currency'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->purchaseOrders = $data['purchaseOrders'] ?? null;
    }

    public static function fromModel(Suppliers $model): self
    {
        $data = [
            'id' => $model->id,
            'company_name' => $model->company_name,
            'contact_person' => $model->contact_person,
            'email' => $model->email,
            'phone' => $model->phone,
            'country' => $model->country,
            'payment_terms' => $model->payment_terms,
            'currency' => $model->currency,
            'address' => $model->address,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('purchaseOrders')) {
            $data['purchaseOrders'] = $model->purchaseOrders->map(fn (PurchaseOrders $po) => PurchaseOrdersDTO::fromModel($po))->all();
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
            'company_name' => $this->companyName,
            'contact_person' => $this->contactPerson,
            'email' => $this->email,
            'phone' => $this->phone,
            'country' => $this->country,
            'payment_terms' => $this->paymentTerms,
            'currency' => $this->currency,
            'address' => $this->address,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'company_name' => $this->companyName,
            'contact_person' => $this->contactPerson,
            'email' => $this->email,
            'phone' => $this->phone,
            'country' => $this->country,
            'payment_terms' => $this->paymentTerms,
            'currency' => $this->currency,
            'address' => $this->address,
            'status' => $this->status,
        ];
    }
}
