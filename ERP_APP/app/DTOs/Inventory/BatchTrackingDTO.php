<?php

namespace App\DTOs\Inventory;

class BatchTrackingDTO
{
    public readonly int $product_id;
    public readonly string $batch_lot_number;
    public readonly ?string $serial_number;
    public readonly float $quantity;
    public readonly ?string $manufacturing_date;
    public readonly ?string $expiry_date;
    public readonly ?string $status;
    public readonly ?string $warehouse_location;
    public readonly ?float $cost_per_unit;

    public function __construct(array $data)
    {
        $this->product_id = (int)($data['product_id'] ?? 0);
        $this->batch_lot_number = $data['batch_lot_number'] ?? $data['batch_number'] ?? '';
        $this->serial_number = $data['serial_number'] ?? null;
        $this->quantity = isset($data['quantity']) 
            ? (float)$data['quantity'] 
            : (isset($data['current_quantity']) ? (float)$data['current_quantity'] : (isset($data['initial_quantity']) ? (float)$data['initial_quantity'] : 0));
        $this->manufacturing_date = $data['manufacturing_date'] ?? null;
        $this->expiry_date = $data['expiry_date'] ?? null;
        $this->status = $data['status'] ?? 'active';
        $this->warehouse_location = $data['warehouse_location'] ?? null;
        $this->cost_per_unit = isset($data['cost_per_unit']) ? (float)$data['cost_per_unit'] : null;
    }
}