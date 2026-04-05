<?php

namespace App\DTOs\Inventory;

class BatchTrackingDTO
{
    public function __construct(
        public readonly int $product_id,
        public readonly string $batch_lot_number,
        public readonly ?string $serial_number = null,
        public readonly float $quantity = 0,
        public readonly ?string $manufacturing_date = null,
        public readonly ?string $expiry_date = null,
        public readonly ?string $status = 'active',
        public readonly ?string $warehouse_location = null,
        public readonly ?float $cost_per_unit = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            product_id: (int) $data['product_id'],
            batch_lot_number: $data['batch_lot_number'] ?? $data['batch_number'],
            serial_number: $data['serial_number'] ?? null,
            quantity: (float) ($data['quantity'] ?? $data['current_quantity'] ?? $data['initial_quantity'] ?? 0),
            manufacturing_date: $data['manufacturing_date'] ?? null,
            expiry_date: $data['expiry_date'] ?? null,
            status: $data['status'] ?? 'active',
            warehouse_location: $data['warehouse_location'] ?? null,
            cost_per_unit: isset($data['cost_per_unit']) ? (float) $data['cost_per_unit'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'batch_lot_number' => $this->batch_lot_number,
            'serial_number' => $this->serial_number,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'manufacturing_date' => $this->manufacturing_date,
            'expiry_date' => $this->expiry_date,
            'status' => $this->status,
            'warehouse_location' => $this->warehouse_location,
            'cost_per_unit' => $this->cost_per_unit,
        ];
    }
}
