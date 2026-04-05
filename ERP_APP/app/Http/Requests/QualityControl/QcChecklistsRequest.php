<?php

namespace App\Http\Requests\QualityControl;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class QcChecklistsRequest extends FormRequest
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
                'status' => 'nullable|in:passed,failed,pending',
                'inspection_type' => 'nullable|in:Incoming,In-Process,Final',
                'search' => 'nullable|string'
            ];
        }

        return [
            'checklist_number' => 'nullable|string|max:50',
            'name' => 'nullable|string|max:255',
            'product_id' => 'nullable|integer',
            'product_batch_work_order' => 'nullable|string|max:255',
            'inspector_id' => 'nullable|exists:employees,id',
            'inspection_type' => 'required|in:Incoming,In-Process,Final',
            'inspection_date' => 'nullable|date',
            'sample_size' => 'nullable|integer|min:1',
            'items_checked' => 'nullable|integer|min:1',
            'items_passed' => 'nullable|integer|min:0',
            'status' => 'required|in:passed,failed,pending,Active,Inactive',
            'checklist_items' => 'nullable',
            'criteria' => 'nullable',
            'notes' => 'nullable|string|max:1000'
        ];
    }

    public function messages(): array
    {
        return [
            'checklist_number.required' => 'Checklist number is required',
            'checklist_number.unique' => 'Checklist number already exists',
            'product_batch_work_order.required' => 'Product/Batch/Work Order is required',
            'inspector_id.required' => 'Inspector is required',
            'inspector_id.exists' => 'Selected inspector does not exist',
            'inspection_type.required' => 'Inspection type is required',
            'inspection_type.in' => 'Inspection type must be one of: Incoming, In-Process, Final',
            'inspection_date.required' => 'Inspection date is required',
            'inspection_date.date' => 'Inspection date must be a valid date',
            'sample_size.required' => 'Sample size is required',
            'sample_size.integer' => 'Sample size must be an integer',
            'sample_size.min' => 'Sample size must be at least 1',
            'items_checked.required' => 'Items checked is required',
            'items_checked.integer' => 'Items checked must be an integer',
            'items_checked.min' => 'Items checked must be at least 1',
            'items_passed.required' => 'Items passed is required',
            'items_passed.integer' => 'Items passed must be an integer',
            'items_passed.min' => 'Items passed must be at least 0',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of: passed, failed, pending'
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
