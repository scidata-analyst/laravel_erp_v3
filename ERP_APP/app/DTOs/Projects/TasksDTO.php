<?php

namespace App\DTOs\Projects;

class TasksDTO
{
    public readonly ?string $task_name;
    public readonly ?string $project_name;
    public readonly ?int $assigned_to;
    public readonly ?string $priority;
    public readonly ?string $due_date;
    public readonly ?string $status;
    public readonly ?string $description;

    public function __construct(array $data)
    {
        $this->task_name    = $data['task_name'] ?? null;
        $this->project_name = $data['project_name'] ?? null;
        $this->assigned_to  = isset($data['assigned_to']) ? (int)$data['assigned_to'] : null;
        $this->priority     = $data['priority'] ?? null;
        $this->due_date     = $data['due_date'] ?? null;
        $this->status       = $data['status'] ?? null;
        $this->description  = $data['description'] ?? null;
    }
}