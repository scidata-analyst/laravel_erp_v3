<?php

namespace App\DTOs\Projects;

class ResourcesDTO
{
    public readonly ?int $project;
    public readonly ?string $employee;
    public readonly ?string $role;
    public readonly ?float $allocation_percentage;
    public readonly ?string $start_date;
    public readonly ?string $end_date;
    public readonly ?float $availability;

    public function __construct(array $data)
    {
        $this->project               = isset($data['project']) ? (int)$data['project'] : null;
        $this->employee              = $data['employee'] ?? null;
        $this->role                  = $data['role'] ?? null;
        $this->allocation_percentage = isset($data['allocation_percentage']) ? (float)$data['allocation_percentage'] : null;
        $this->start_date            = $data['start_date'] ?? null;
        $this->end_date              = $data['end_date'] ?? null;
        $this->availability          = isset($data['availability']) ? (float)$data['availability'] : null;
    }
}