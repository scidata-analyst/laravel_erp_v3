<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ResourcesRequest extends FormRequest
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
                'type' => 'nullable|in:Human,Material,Equipment',
                'availability' => 'nullable|in:Available,Busy,OOF'
            ];
        }

        return [
            'name' => 'required|string|max:255',
            'project_id' => 'nullable',
            'type' => 'required_without:resource_type|in:Human,Material,Equipment,Employee,Contractor',
            'resource_type' => 'required_without:type|in:Human,Material,Equipment,Employee,Contractor',
            'allocation' => 'nullable|integer|min:0|max:100',
            'allocation_percentage' => 'nullable|integer|min:0|max:100',
            'cost_per_hour' => 'nullable|numeric|min:0',
            'availability' => 'nullable|in:Available,Busy,OOF',
            'status' => 'nullable|in:Active,Inactive,Completed',
            'skills' => 'nullable|array',
            'notes' => 'nullable|string|max:500',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
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
