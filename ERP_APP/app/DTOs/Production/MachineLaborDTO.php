<?php

namespace App\DTOs\Production;

class MachineLaborDTO
{
    public readonly ?int $work_order;
    public readonly ?string $resource;
    public readonly ?string $type;
    public readonly ?float $schedule_hour;
    public readonly ?float $actual_hour;
    public readonly ?float $cost;
    public readonly ?float $total_cost;

    public function __construct(array $data)
    {
        $this->work_order      = $data['work_order'] ?? null;
        $this->resource        = $data['resource'] ?? null;
        $this->type            = $data['type'] ?? null;
        $this->schedule_hour   = $data['schedule_hour'] ?? null;
        $this->actual_hour     = $data['actual_hour'] ?? null;
        $this->cost            = $data['cost'] ?? null;
        $this->total_cost      = $data['total_cost'] ?? null;
    }
}