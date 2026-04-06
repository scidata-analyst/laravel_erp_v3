<?php

namespace App\DTOs\Production;

class BomDTO
{
    public readonly ?string $bom_number;
    public readonly ?string $product;
    public readonly ?string $version;
    public readonly ?float $estimated_cost;
    public readonly ?float $lead_time;
    public readonly ?string $status;
    public readonly ?string $component;

    public function __construct(array $data)
    {
        $this->bom_number     = $data['bom_number'] ?? null;
        $this->product        = $data['product'] ?? null;
        $this->version        = $data['version'] ?? null;
        $this->estimated_cost = $data['estimated_cost'] ?? null;
        $this->lead_time      = $data['lead_time'] ?? null;
        $this->status         = $data['status'] ?? null;
        $this->component      = $data['component'] ?? null;
    }
}