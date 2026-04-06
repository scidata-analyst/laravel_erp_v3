<?php

namespace App\DTOs\Purchase;

class GrnDTO
{
    public readonly ?string $grn_number;
    public readonly ?int $purchase_order_id;
    public readonly ?int $supplier_id;
    public readonly ?string $received_date;
    public readonly ?string $status;
    public readonly ?string $notes;
    public readonly ?string $received_by;

    public function __construct(array $data)
    {
        $this->grn_number       = $data['grn_number'] ?? null;
        $this->purchase_order_id = isset($data['purchase_order_id']) ? (int)$data['purchase_order_id'] : null;
        $this->supplier_id      = isset($data['supplier_id']) ? (int)$data['supplier_id'] : null;
        $this->received_date    = $data['received_date'] ?? null;
        $this->status           = $data['status'] ?? null;
        $this->notes            = $data['notes'] ?? null;
        $this->received_by      = $data['received_by'] ?? null;
    }
}