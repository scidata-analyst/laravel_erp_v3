<?php

namespace App\DTOs\Projects;

class ResourcesDTO
{
    public function __construct(
        public readonly int $project_id,
        public readonly string $resource_name,
        public readonly string $resource_type,
        public readonly int $allocation_percentage,
        public readonly ?string $start_date = null,
        public readonly ?string $end_date = null,
        public readonly ?float $cost_per_hour = null,
        public readonly ?string $status = 'Active',
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            project_id: (int) $data['project_id'],
            resource_name: $data['resource_name'] ?? $data['name'],
            resource_type: $data['resource_type'],
            allocation_percentage: (int) ($data['allocation_percentage'] ?? $data['allocation']),
            start_date: $data['start_date'] ?? null,
            end_date: $data['end_date'] ?? null,
            cost_per_hour: isset($data['cost_per_hour']) ? (float) $data['cost_per_hour'] : null,
            status: $data['status'] ?? 'Active',
        );
    }

    public function toArray(): array
    {
        return [
            'project_id' => $this->project_id,
            'resource_name' => $this->resource_name,
            'resource_type' => $this->resource_type,
            'allocation_percentage' => $this->allocation_percentage,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'cost_per_hour' => $this->cost_per_hour,
            'status' => $this->status,
        ];
    }
}
