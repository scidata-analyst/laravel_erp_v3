<?php

namespace App\DTOs\Projects;

use App\DTOs\UsersRoles\UserDTO;
use App\Models\Projects\Tasks;

/**
 * Data Transfer Object for Tasks entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates project task data.
 *
 * @property int|null $id
 * @property string|null $taskTitle
 * @property string|null $projectName
 * @property int|null $assignedUserId
 * @property string|null $priority
 * @property string|null $dueDate
 * @property int|null $status
 * @property string|null $description
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property UserDTO|null $assignedUser
 */
class TasksDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Title of the task */
    public ?string $taskTitle;

    /** @var string|null Name of the project */
    public ?string $projectName;

    /** @var int|null Foreign key to users table (assignee) */
    public ?int $assignedUserId;

    /** @var string|null Priority level (e.g., 'Low', 'Medium', 'High', 'Critical') */
    public ?string $priority;

    /** @var string|null Due date (Y-m-d) */
    public ?string $dueDate;

    /** @var int|null Status: 0=Pending, 1=InProgress, 2=Completed, 3=Cancelled */
    public ?int $status;

    /** @var string|null Task description */
    public ?string $description;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var UserDTO|null Assigned user */
    public ?UserDTO $assignedUser;

    /**
     * Create a new TasksDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Tasks $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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

    /**
     * Create DTO from plain array data.
     *
     * @param array $data Associative array with DTO properties
     * @return self New DTO instance
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Convert DTO to array representation.
     *
     * @return array Array with snake_case keys matching database columns
     */
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

    /**
     * Convert DTO to array for Eloquent model creation/update.
     *
     * Returns fillable attributes only, excluding timestamps
     * and foreign keys for related models.
     *
     * @return array Associative array for model mass assignment
     */
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
