<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class TasksRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('get')) {
            return [
                'per_page' => 'nullable|integer|min:1|max:100',
                'project_id' => 'nullable',
                'status' => 'nullable|string|in:To Do,In Progress,Review,Done',
                'search' => 'nullable|string'
            ];
        }

        return [
            'task_name' => 'required_without:title|string|max:255',
            'title' => 'required_without:task_name|string|max:255',
            'project_id' => 'required',
            'assigned_to' => 'nullable',
            'due_date' => 'nullable|date',
            'priority' => 'nullable|string|in:Low,Medium,High,Critical',
            'status' => 'nullable|string|in:To Do,In Progress,Review,Done,Todo',
            'progress' => 'nullable|integer|min:0|max:100',
            'description' => 'nullable|string',
        ];
    }
}
