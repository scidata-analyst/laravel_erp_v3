<?php

namespace App\DTOs\Ecommerce;

use App\DTOs\Logistics\WarehousesDTO;
use App\DTOs\UsersRoles\UserDTO;
use App\Models\Ecommerce\Pos;

class PosDTO
{
    public ?int $id;

    public ?string $terminalId;

    public ?string $location;

    public ?int $assignedCashierId;

    public ?int $warehouseId;

    public ?string $receiptPrinter;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?UserDTO $assignedCashier;

    public ?WarehousesDTO $warehouse;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
