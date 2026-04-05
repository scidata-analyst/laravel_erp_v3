<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProjectCostRequest extends FormRequest
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
                'project_id' => 'nullable|exists:projects,id',
                'status' => 'nullable|in:pending,approved,rejected'
            ];
        }

        return [
            'project_id' => 'required',
            'cost_category' => 'required_without:category|string|max:100',
            'category' => 'required_without:cost_category|string|max:100',
            'description' => 'nullable|string|max:500',
            'budgeted_amount' => 'nullable|numeric|min:0',
            'actual_amount' => 'nullable|numeric|min:0',
            'amount' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|size:3',
            'cost_date' => 'nullable|date',
            'date' => 'nullable|date',
            'approved_by' => 'nullable',
            'status' => 'required|in:pending,approved,rejected,Pending,Approved,Rejected'
        ];
    }

    public function messages(): array
    {
        return [
            'project_id.required' => 'Project ID is required',
            'project_id.exists' => 'Selected project does not exist',
            'cost_category.required' => 'Cost category is required',
            'budgeted_amount.required' => 'Budgeted amount is required',
            'budgeted_amount.numeric' => 'Budgeted amount must be a number',
            'actual_amount.required' => 'Actual amount is required',
            'actual_amount.numeric' => 'Actual amount must be a number',
            'currency.required' => 'Currency is required',
            'currency.size' => 'Currency must be 3 characters',
            'cost_date.required' => 'Cost date is required',
            'cost_date.date' => 'Cost date must be a valid date',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of: pending, approved, rejected'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}
