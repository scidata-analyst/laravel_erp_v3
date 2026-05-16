<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Project Task.
 */
class TasksStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'task_title' => ['required', 'string', 'max:255'],
            'project_name' => ['required', 'string', 'max:255'],
            'assigned_user_id' => ['nullable', 'integer'],
            'priority' => ['required', 'string', 'max:20'],
            'due_date' => ['required', 'date'],
            'status' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'task_title.required' => 'The task title is required.',
            'project_name.required' => 'The project name is required.',
            'priority.required' => 'The priority is required.',
            'due_date.required' => 'The due date is required.',
        ];
    }
}