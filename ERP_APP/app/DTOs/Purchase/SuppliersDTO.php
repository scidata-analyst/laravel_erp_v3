<?php

namespace App\DTOs\Purchase;

use App\Models\Purchase\PurchaseOrders;
use App\Models\Purchase\Suppliers;

/**
 * Data Transfer Object for Suppliers entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates supplier/vendor data with relationships.
 *
 * @property int|null $id
 * @property string|null $companyName
 * @property string|null $contactPerson
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $country
 * @property string|null $paymentTerms
 * @property string|null $currency
 * @property string|null $address
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property array|null $purchaseOrders
 */
class SuppliersDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Supplier company name */
    public ?string $companyName;

    /** @var string|null Contact person name */
    public ?string $contactPerson;

    /** @var string|null Email address */
    public ?string $email;

    /** @var string|null Phone number */
    public ?string $phone;

    /** @var string|null Country */
    public ?string $country;

    /** @var string|null Payment terms (e.g., 'Net 30', 'Net 60') */
    public ?string $paymentTerms;

    /** @var string|null Currency code (e.g., 'USD', 'EUR') */
    public ?string $currency;

    /** @var string|null Full address */
    public ?string $address;

    /** @var int|null Status: 0=Inactive, 1=Active, 2=Blocked */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var array|null Collection of related purchase orders */
    public ?array $purchaseOrders;

    /**
     * Create a new SuppliersDTO instance.
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
        $this->country = $data['country'] ?? null;
        $this->paymentTerms = $data['payment_terms'] ?? null;
        $this->currency = $data['currency'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->purchaseOrders = $data['purchaseOrders'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Suppliers $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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
            'country' => $this->country,
            'payment_terms' => $this->paymentTerms,
            'currency' => $this->currency,
            'address' => $this->address,
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
            'country' => $this->country,
            'payment_terms' => $this->paymentTerms,
            'currency' => $this->currency,
            'address' => $this->address,
            'status' => $this->status,
        ];
    }
}
