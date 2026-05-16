<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Project Task.
 */
class TasksUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'task_title' => ['sometimes', 'string', 'max:255'],
            'project_name' => ['sometimes', 'string', 'max:255'],
            'assigned_user_id' => ['nullable', 'integer'],
            'priority' => ['sometimes', 'string', 'max:20'],
            'due_date' => ['sometimes', 'date'],
            'status' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}