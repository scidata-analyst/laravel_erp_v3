<?php

namespace App\Http\Requests\QualityControl;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new QC Checklist.
 */
class QcChecklistsStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_batch_work_order' => ['required', 'string', 'max:100'],
            'inspector_id' => ['required', 'integer'],
            'inspection_type' => ['required', 'string', 'max:50'],
            'inspection_date' => ['required', 'date'],
            'sample_size' => ['required', 'integer', 'min:1'],
            'checklist_items_notes' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_batch_work_order.required' => 'The work order is required.',
            'inspector_id.required' => 'The inspector is required.',
            'inspection_type.required' => 'The inspection type is required.',
            'inspection_date.required' => 'The inspection date is required.',
            'sample_size.required' => 'The sample size is required.',
            'sample_size.min' => 'Sample size must be at least 1.',
        ];
    }
}