<?php

namespace App\Http\Requests\Projects;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Task data.
 *
 * Validates fields based on the Tasks model fillable attributes:
 * - task_title: required, string, max 255
 * - project_name: required, string, max 255
 * - assigned_user_id: nullable, exists in users table (foreign key relationship)
 * - priority: nullable, string, max 50
 * - due_date: nullable, date
 * - status: nullable, string, max 50
 * - description: nullable, string, max 1000
 */
class TasksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the task ID for unique validation on updates
        $taskId = $this->route('task');

        return [
            // Task title: required, string, max 255 characters
            'task_title' => ['required', 'string', 'max:255'],

            // Project name: required, string, max 255 characters
            'project_name' => ['required', 'string', 'max:255'],

            // Assigned user: optional, must exist in users table
            'assigned_user_id' => ['nullable', 'exists:App\Models\UsersRoles\User,id'],

            // Priority: optional, string, max 50 characters (e.g., low, medium, high, urgent)
            'priority' => ['nullable', 'string', 'max:50'],

            // Due date: optional, must be a valid date
            'due_date' => ['nullable', 'date'],

            // Status: optional, string, max 50 characters (e.g., pending, in_progress, completed)
            'status' => ['nullable', 'string', 'max:50'],

            // Description: optional, string, max 1000 characters
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'task_title.required' => 'The task title is required.',
            'task_title.max' => 'Task title must not exceed 255 characters.',
            'project_name.required' => 'The project name is required.',
            'project_name.max' => 'Project name must not exceed 255 characters.',
            'assigned_user_id.exists' => 'The selected user does not exist.',
            'priority.max' => 'Priority must not exceed 50 characters.',
            'due_date.date' => 'Please enter a valid date.',
            'status.max' => 'Status must not exceed 50 characters.',
            'description.max' => 'Description must not exceed 1000 characters.',
        ];
    }
}
