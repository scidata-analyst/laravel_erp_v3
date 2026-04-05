<?php

namespace App\DTOs\Production;

class WorkOrdersDTO
{
    public function __construct(
        public readonly ?string $wo_number = null,
        public readonly int $product_bom_id = 0,
        public readonly int $qty_to_produce = 0,
        public readonly ?string $priority = 'Medium',
        public readonly ?string $start_date = null,
        public readonly ?string $end_date = null,
        public readonly ?int $assigned_to = null,
        public readonly ?string $status = 'Scheduled',
        public readonly ?int $actual_qty_produced = 0,
        public readonly ?int $scrap_quantity = 0,
        public readonly ?string $notes = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            wo_number: $data['wo_number'] ?? null,
            product_bom_id: (int) ($data['product_bom_id'] ?? $data['product_id'] ?? 0),
            qty_to_produce: (int) ($data['qty_to_produce'] ?? $data['quantity'] ?? 0),
            priority: $data['priority'] ?? 'Medium',
            start_date: $data['start_date'] ?? null,
            end_date: $data['end_date'] ?? null,
            assigned_to: isset($data['assigned_to']) ? (int) $data['assigned_to'] : null,
            status: $data['status'] ?? 'Scheduled',
            actual_qty_produced: isset($data['actual_qty_produced']) ? (int) $data['actual_qty_produced'] : (isset($data['produced_qty']) ? (int) $data['produced_qty'] : 0),
            scrap_quantity: isset($data['scrap_quantity']) ? (int) $data['scrap_quantity'] : (isset($data['scrap_qty']) ? (int) $data['scrap_qty'] : 0),
            notes: $data['notes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'wo_number' => $this->wo_number,
            'product_bom_id' => $this->product_bom_id,
            'qty_to_produce' => $this->qty_to_produce,
            'priority' => $this->priority,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'assigned_to' => $this->assigned_to,
            'status' => $this->status,
            'actual_qty_produced' => $this->actual_qty_produced,
            'scrap_quantity' => $this->scrap_quantity,
            'notes' => $this->notes,
        ];
    }
}
