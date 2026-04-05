<?php

namespace App\DTOs\Projects;

class TasksDTO
{
    public function __construct(
        public readonly string $project_name,
        public readonly string $task_title,
        public readonly ?string $description = null,
        public readonly ?int $assigned_to = null,
        public readonly ?string $start_date = null,
        public readonly ?string $end_date = null,
        public readonly ?string $priority = 'Medium',
        public readonly ?string $status = 'In Progress',
        public readonly ?int $progress_percentage = 0,
        public readonly ?float $estimated_hours = 0,
        public readonly ?array $dependencies = [],
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            project_name: (string) ($data['project_name'] ?? $data['project_id']),
            task_title: $data['task_title'] ?? $data['title'],
            description: $data['description'] ?? null,
            assigned_to: isset($data['assigned_to']) ? (int) $data['assigned_to'] : null,
            start_date: $data['start_date'] ?? null,
            end_date: $data['end_date'] ?? $data['due_date'] ?? null,
            priority: $data['priority'] ?? 'Medium',
            status: $data['status'] ?? 'In Progress',
            progress_percentage: isset($data['progress_percentage']) ? (int) $data['progress_percentage'] : (isset($data['progress']) ? (int) $data['progress'] : 0),
            estimated_hours: isset($data['estimated_hours']) ? (float) $data['estimated_hours'] : 0,
            dependencies: $data['dependencies'] ?? [],
        );
    }

    public function toArray(): array
    {
        return [
            'project_name' => $this->project_name,
            'task_title' => $this->task_title,
            'description' => $this->description,
            'assigned_to' => $this->assigned_to,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'priority' => $this->priority,
            'status' => $this->status,
            'progress_percentage' => $this->progress_percentage,
            'estimated_hours' => $this->estimated_hours,
            'dependencies' => $this->dependencies,
        ];
    }
}
