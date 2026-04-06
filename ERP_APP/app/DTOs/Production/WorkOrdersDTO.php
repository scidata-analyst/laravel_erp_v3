<?php

namespace App\DTOs\Production;

class WorkOrdersDTO
{
    public readonly ?string $wo_number;
    public readonly ?string $product;
    public readonly ?string $bom;
    public readonly ?int $quantity;
    public readonly ?string $start_date;
    public readonly ?string $end_date;
    public readonly ?string $status;
    public readonly ?int $assigned_to;
    public readonly ?string $priority;

    public function __construct(array $data)
    {
        $this->wo_number   = $data['wo_number'] ?? null;
        $this->product     = $data['product'] ?? null;
        $this->bom         = $data['bom'] ?? null;
        $this->quantity    = isset($data['quantity']) ? (int)$data['quantity'] : null;
        $this->start_date  = $data['start_date'] ?? null;
        $this->end_date    = $data['end_date'] ?? null;
        $this->status      = $data['status'] ?? null;
        $this->assigned_to = isset($data['assigned_to']) ? (int)$data['assigned_to'] : null;
        $this->priority    = $data['priority'] ?? null;
    }
}