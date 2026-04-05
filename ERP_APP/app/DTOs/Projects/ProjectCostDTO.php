<?php

namespace App\DTOs\Projects;

class ProjectCostDTO
{
    public function __construct(
        public readonly int $project_id,
        public readonly string $cost_category,
        public readonly float $budgeted_amount,
        public readonly ?float $actual_amount = 0,
        public readonly ?string $description = null,
        public readonly ?string $cost_date = null,
        public readonly ?int $approved_by = null,
        public readonly ?string $status = 'Pending',
    ) {}

    public static function fromRequest(array $data): self
    {
        $amount = (float) ($data['amount'] ?? 0);

        return new self(
            project_id: (int) $data['project_id'],
            cost_category: $data['cost_category'] ?? $data['category'],
            budgeted_amount: isset($data['budgeted_amount']) ? (float) $data['budgeted_amount'] : $amount,
            actual_amount: isset($data['actual_amount']) ? (float) $data['actual_amount'] : $amount,
            description: $data['description'] ?? null,
            cost_date: $data['cost_date'] ?? $data['date'] ?? null,
            approved_by: isset($data['approved_by']) ? (int) $data['approved_by'] : null,
            status: $data['status'] ?? 'Pending',
        );
    }

    public function toArray(): array
    {
        return [
            'project_id' => $this->project_id,
            'cost_category' => $this->cost_category,
            'budgeted_amount' => $this->budgeted_amount,
            'actual_amount' => $this->actual_amount,
            'description' => $this->description,
            'cost_date' => $this->cost_date,
            'approved_by' => $this->approved_by,
            'status' => $this->status,
        ];
    }
}
