<?php

namespace App\DTOs\Logistics;

use App\DTOs\Inventory\ProductCatalogDTO;
use App\DTOs\UsersRoles\UserDTO;
use App\Models\Logistics\Warehouses;

class WarehousesDTO
{
    public ?int $id;

    public ?string $warehouseName;

    public ?string $warehouseCode;

    public ?string $warehouseType;

    public ?string $locationAddress;

    public ?int $managerId;

    public ?int $capacityUnits;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?UserDTO $manager;

    public ?array $products;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
