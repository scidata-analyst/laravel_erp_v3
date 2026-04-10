<?php

namespace App\DTOs\Ecommerce;

use App\DTOs\Logistics\WarehousesDTO;
use App\DTOs\UsersRoles\UserDTO;
use App\Models\Ecommerce\Pos;

/**
 * Data Transfer Object for Pos (Point of Sale) entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates POS terminal data.
 *
 * @property int|null $id
 * @property string|null $terminalId
 * @property string|null $location
 * @property int|null $assignedCashierId
 * @property int|null $warehouseId
 * @property string|null $receiptPrinter
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property UserDTO|null $assignedCashier
 * @property WarehousesDTO|null $warehouse
 */
class PosDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Unique terminal identifier (e.g., 'POS-001') */
    public ?string $terminalId;

    /** @var string|null Physical location of POS terminal */
    public ?string $location;

    /** @var int|null Foreign key to users table (assigned cashier) */
    public ?int $assignedCashierId;

    /** @var int|null Foreign key to warehouses table */
    public ?int $warehouseId;

    /** @var string|null Receipt printer name/connection */
    public ?string $receiptPrinter;

    /** @var int|null Status: 0=Inactive, 1=Active, 2=Offline, 3=Maintenance */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var UserDTO|null Related assigned cashier */
    public ?UserDTO $assignedCashier;

    /** @var WarehousesDTO|null Related warehouse */
    public ?WarehousesDTO $warehouse;

    /**
     * Create a new PosDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->terminalId = $data['terminal_id'] ?? null;
        $this->location = $data['location'] ?? null;
        $this->assignedCashierId = isset($data['assigned_cashier_id']) ? (int) $data['assigned_cashier_id'] : null;
        $this->warehouseId = isset($data['warehouse_id']) ? (int) $data['warehouse_id'] : null;
        $this->receiptPrinter = $data['receipt_printer'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->assignedCashier = $data['assignedCashier'] ?? null;
        $this->warehouse = $data['warehouse'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Pos $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(Pos $model): self
    {
        $data = [
            'id' => $model->id,
            'terminal_id' => $model->terminal_id,
            'location' => $model->location,
            'assigned_cashier_id' => $model->assigned_cashier_id,
            'warehouse_id' => $model->warehouse_id,
            'receipt_printer' => $model->receipt_printer,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('assigned_cashier')) {
            $data['assignedCashier'] = UserDTO::fromModel($model->assigned_cashier);
        }

        if ($model->relationLoaded('warehouse')) {
            $data['warehouse'] = WarehousesDTO::fromModel($model->warehouse);
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
            'terminal_id' => $this->terminalId,
            'location' => $this->location,
            'assigned_cashier_id' => $this->assignedCashierId,
            'warehouse_id' => $this->warehouseId,
            'receipt_printer' => $this->receiptPrinter,
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
            'terminal_id' => $this->terminalId,
            'location' => $this->location,
            'assigned_cashier_id' => $this->assignedCashierId,
            'warehouse_id' => $this->warehouseId,
            'receipt_printer' => $this->receiptPrinter,
            'status' => $this->status,
        ];
    }
}
