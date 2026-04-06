<?php

namespace App\DTOs\Projects;

class ProjectCostDTO
{
    public readonly ?int $project;
    public readonly ?float $budget;
    public readonly ?float $spent;
    public readonly ?float $remaining;
    public readonly ?float $used;
    public readonly ?float $variance;
    public readonly ?string $status;
    public readonly ?string $cost_category;
    public readonly ?string $date_incurred;
    public readonly ?int $approved_by;
    public readonly ?string $notes;

    public function __construct(array $data)
    {
        $this->project       = isset($data['project']) ? (int)$data['project'] : null;
        $this->budget        = isset($data['budget']) ? (float)$data['budget'] : null;
        $this->spent         = isset($data['spent']) ? (float)$data['spent'] : null;
        $this->remaining     = isset($data['remaining']) ? (float)$data['remaining'] : null;
        $this->used          = isset($data['used']) ? (float)$data['used'] : null;
        $this->variance      = isset($data['variance']) ? (float)$data['variance'] : null;
        $this->status        = $data['status'] ?? null;
        $this->cost_category = $data['cost_category'] ?? null;
        $this->date_incurred = $data['date_incurred'] ?? null;
        $this->approved_by   = isset($data['approved_by']) ? (int)$data['approved_by'] : null;
        $this->notes         = $data['notes'] ?? null;
    }
}