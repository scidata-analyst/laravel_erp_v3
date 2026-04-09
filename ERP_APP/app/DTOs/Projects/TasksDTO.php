<?php

namespace App\DTOs\Projects;

use App\DTOs\UsersRoles\UserDTO;
use App\Models\Projects\Tasks;

class TasksDTO
{
    public ?int $id;

    public ?string $taskTitle;

    public ?string $projectName;

    public ?int $assignedUserId;

    public ?string $priority;

    public ?string $dueDate;

    public ?int $status;

    public ?string $description;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?UserDTO $assignedUser;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->taskTitle = $data['task_title'] ?? null;
        $this->projectName = $data['project_name'] ?? null;
        $this->assignedUserId = isset($data['assigned_user_id']) ? (int) $data['assigned_user_id'] : null;
        $this->priority = $data['priority'] ?? null;
        $this->dueDate = $data['due_date'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->description = $data['description'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->assignedUser = $data['assignedUser'] ?? null;
    }

    public static function fromModel(Tasks $model): self
    {
        $data = [
            'id' => $model->id,
            'task_title' => $model->task_title,
            'project_name' => $model->project_name,
            'assigned_user_id' => $model->assigned_user_id,
            'priority' => $model->priority,
            'due_date' => $model->due_date,
            'status' => $model->status,
            'description' => $model->description,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('assignedUser')) {
            $data['assignedUser'] = UserDTO::fromModel($model->assignedUser);
        }

        return new self($data);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'task_title' => $this->taskTitle,
            'project_name' => $this->projectName,
            'assigned_user_id' => $this->assignedUserId,
            'priority' => $this->priority,
            'due_date' => $this->dueDate,
            'status' => $this->status,
            'description' => $this->description,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'task_title' => $this->taskTitle,
            'project_name' => $this->projectName,
            'assigned_user_id' => $this->assignedUserId,
            'priority' => $this->priority,
            'due_date' => $this->dueDate,
            'status' => $this->status,
            'description' => $this->description,
        ];
    }
}
