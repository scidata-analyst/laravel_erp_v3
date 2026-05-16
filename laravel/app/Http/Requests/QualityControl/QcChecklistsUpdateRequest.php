<?php

namespace App\Http\Requests\QualityControl;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing QC Checklist.
 */
class QcChecklistsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_batch_work_order' => ['sometimes', 'string', 'max:100'],
            'inspector_id' => ['sometimes', 'integer'],
            'inspection_type' => ['sometimes', 'string', 'max:50'],
            'inspection_date' => ['sometimes', 'date'],
            'sample_size' => ['sometimes', 'integer', 'min:1'],
            'checklist_items_notes' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'sample_size.min' => 'Sample size must be at least 1.',
        ];
    }
}