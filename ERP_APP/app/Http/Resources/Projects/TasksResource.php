<?php

namespace App\Http\Resources\Projects;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'task_name' => $this->task_title,
            'title' => $this->task_title,
            'project_id' => $this->project_name,
            'project' => $this->project_name,
            'assigned_to' => $this->assignedUser?->name ?? $this->assigned_to,
            'description' => $this->description,
            'due_date' => $this->end_date?->toDateString(),
            'priority' => $this->priority,
            'status' => $this->status === 'To Do' ? 'Todo' : $this->status,
            'progress' => $this->progress_percentage,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
