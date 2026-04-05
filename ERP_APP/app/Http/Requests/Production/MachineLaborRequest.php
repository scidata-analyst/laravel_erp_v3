<?php

namespace App\Http\Requests\Production;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class MachineLaborRequest extends FormRequest
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
                'work_order_id' => 'nullable|exists:work_orders,id',
                'type' => 'nullable|in:Machine,Labor'
            ];
        }

        return [
            'work_order_id' => 'required|exists:work_orders,id',
            'resource_name' => 'required|string|max:255',
            'type' => 'required|in:Machine,Labor',
            'scheduled_hours' => 'required|numeric|min:0|max:24',
            'actual_hours' => 'nullable|numeric|min:0|max:24',
            'cost_per_hour' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:1000'
        ];
    }

    public function messages(): array
    {
        return [
            'work_order_id.required' => 'Work order is required',
            'work_order_id.exists' => 'Selected work order does not exist',
            'resource_name.required' => 'Resource name is required',
            'type.required' => 'Type is required',
            'type.in' => 'Type must be one of: Machine, Labor',
            'scheduled_hours.required' => 'Scheduled hours is required',
            'scheduled_hours.max' => 'Scheduled hours must not be more than 24',
            'actual_hours.max' => 'Actual hours must not be more than 24',
            'cost_per_hour.required' => 'Cost per hour is required',
            'cost_per_hour.numeric' => 'Cost per hour must be a number',
            'cost_per_hour.min' => 'Cost per hour must be at least 0'
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
