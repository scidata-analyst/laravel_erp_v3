<?php

namespace App\DTOs\Sales;

use App\DTOs\UsersRoles\UserDTO;
use App\Models\Sales\Customers;

class CustomersDTO
{
    public ?int $id;

    public ?string $companyName;

    public ?string $contactPerson;

    public ?string $email;

    public ?string $phone;

    public ?float $creditLimit;

    public ?int $salesRepId;

    public ?string $billingAddress;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?UserDTO $salesRep;

    public ?array $invoices;

    public ?array $salesOrders;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->companyName = $data['company_name'] ?? null;
        $this->contactPerson = $data['contact_person'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->creditLimit = isset($data['credit_limit']) ? (float) $data['credit_limit'] : null;
        $this->salesRepId = isset($data['sales_rep_id']) ? (int) $data['sales_rep_id'] : null;
        $this->billingAddress = $data['billing_address'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->salesRep = $data['sales_rep'] ?? null;
        $this->invoices = $data['invoices'] ?? null;
        $this->salesOrders = $data['salesOrders'] ?? null;
    }

    public static function fromModel(Customers $model): self
    {
        $data = [
            'id' => $model->id,
            'company_name' => $model->company_name,
            'contact_person' => $model->contact_person,
            'email' => $model->email,
            'phone' => $model->phone,
            'credit_limit' => $model->credit_limit,
            'sales_rep_id' => $model->sales_rep_id,
            'billing_address' => $model->billing_address,
            'status' => $model->status ?? null,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('salesRep')) {
            $data['sales_rep'] = UserDTO::fromModel($model->salesRep);
        }

        if ($model->relationLoaded('invoices')) {
            $data['invoices'] = $model->invoices->map(fn ($i) => InvoicesDTO::fromModel($i))->all();
        }

        if ($model->relationLoaded('salesOrders')) {
            $data['salesOrders'] = $model->salesOrders->map(fn ($s) => SalesOrdersDTO::fromModel($s))->all();
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
            'credit_limit' => $this->creditLimit,
            'sales_rep_id' => $this->salesRepId,
            'billing_address' => $this->billingAddress,
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
            'credit_limit' => $this->creditLimit,
            'sales_rep_id' => $this->salesRepId,
            'billing_address' => $this->billingAddress,
            'status' => $this->status,
        ];
    }
}
