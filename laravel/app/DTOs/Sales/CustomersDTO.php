<?php

namespace App\DTOs\Sales;

use App\DTOs\UsersRoles\UserDTO;
use App\Models\Sales\Customers;

/**
 * Data Transfer Object for Customers entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates customer data with relationships.
 *
 * @property int|null $id
 * @property string|null $companyName
 * @property string|null $contactPerson
 * @property string|null $email
 * @property string|null $phone
 * @property float|null $creditLimit
 * @property int|null $salesRepId
 * @property string|null $billingAddress
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property UserDTO|null $salesRep
 * @property array|null $invoices
 * @property array|null $salesOrders
 */
class CustomersDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Company/business name */
    public ?string $companyName;

    /** @var string|null Contact person name */
    public ?string $contactPerson;

    /** @var string|null Email address */
    public ?string $email;

    /** @var string|null Phone number */
    public ?string $phone;

    /** @var float|null Maximum credit limit extended to customer */
    public ?float $creditLimit;

    /** @var int|null Foreign key to users table (sales representative) */
    public ?int $salesRepId;

    /** @var string|null Billing address */
    public ?string $billingAddress;

    /** @var int|null Status: 0=Inactive, 1=Active, 2=Prospect, 3=Blocked */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var UserDTO|null Related sales representative */
    public ?UserDTO $salesRep;

    /** @var array|null Collection of related invoices */
    public ?array $invoices;

    /** @var array|null Collection of related sales orders */
    public ?array $salesOrders;

    /**
     * Create a new CustomersDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Customers $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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
