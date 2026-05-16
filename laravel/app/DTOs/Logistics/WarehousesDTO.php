<?php

namespace App\DTOs\Logistics;

use App\DTOs\Inventory\ProductCatalogDTO;
use App\DTOs\UsersRoles\UserDTO;
use App\Models\Logistics\Warehouses;

/**
 * Data Transfer Object for Warehouses entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates warehouse/location data with relationships.
 *
 * @property int|null $id
 * @property string|null $warehouseName
 * @property string|null $warehouseCode
 * @property string|null $warehouseType
 * @property string|null $locationAddress
 * @property int|null $managerId
 * @property int|null $capacityUnits
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property UserDTO|null $manager
 * @property array|null $products
 */
class WarehousesDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Warehouse name */
    public ?string $warehouseName;

    /** @var string|null Unique warehouse code (e.g., 'WH-001') */
    public ?string $warehouseCode;

    /** @var string|null Warehouse type (e.g., 'Main', 'Distribution', 'Cold Storage') */
    public ?string $warehouseType;

    /** @var string|null Physical address */
    public ?string $locationAddress;

    /** @var int|null Foreign key to users table (warehouse manager) */
    public ?int $managerId;

    /** @var int|null Maximum storage capacity in units */
    public ?int $capacityUnits;

    /** @var int|null Status: 0=Inactive, 1=Active, 2=Full, 3=Maintenance */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var UserDTO|null Related warehouse manager */
    public ?UserDTO $manager;

    /** @var array|null Collection of related products */
    public ?array $products;

    /**
     * Create a new WarehousesDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->warehouseName = $data['warehouse_name'] ?? null;
        $this->warehouseCode = $data['warehouse_code'] ?? null;
        $this->warehouseType = $data['warehouse_type'] ?? null;
        $this->locationAddress = $data['location_address'] ?? null;
        $this->managerId = isset($data['manager_id']) ? (int) $data['manager_id'] : null;
        $this->capacityUnits = isset($data['capacity_units']) ? (int) $data['capacity_units'] : null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->manager = $data['manager'] ?? null;
        $this->products = $data['products'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Warehouses $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(Warehouses $model): self
    {
        $data = [
            'id' => $model->id,
            'warehouse_name' => $model->warehouse_name,
            'warehouse_code' => $model->warehouse_code,
            'warehouse_type' => $model->warehouse_type,
            'location_address' => $model->location_address,
            'manager_id' => $model->manager_id,
            'capacity_units' => $model->capacity_units,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('manager')) {
            $data['manager'] = UserDTO::fromModel($model->manager);
        }

        if ($model->relationLoaded('products')) {
            $data['products'] = $model->products->map(fn ($p) => ProductCatalogDTO::fromModel($p))->all();
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
            'warehouse_name' => $this->warehouseName,
            'warehouse_code' => $this->warehouseCode,
            'warehouse_type' => $this->warehouseType,
            'location_address' => $this->locationAddress,
            'manager_id' => $this->managerId,
            'capacity_units' => $this->capacityUnits,
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
            'warehouse_name' => $this->warehouseName,
            'warehouse_code' => $this->warehouseCode,
            'warehouse_type' => $this->warehouseType,
            'location_address' => $this->locationAddress,
            'manager_id' => $this->managerId,
            'capacity_units' => $this->capacityUnits,
            'status' => $this->status,
        ];
    }
}
