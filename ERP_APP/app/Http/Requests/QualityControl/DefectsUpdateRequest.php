<?php

namespace App\Http\Requests\QualityControl;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Defect record.
 */
class DefectsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['sometimes', 'integer', 'exists:products,id'],
            'batch_lot_number' => ['nullable', 'string', 'max:100'],
            'defect_type' => ['sometimes', 'string', 'max:50'],
            'severity' => ['sometimes', 'string', 'max:20'],
            'quantity_affected' => ['sometimes', 'integer', 'min:1'],
            'description_root_cause' => ['sometimes', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.exists' => 'The selected product is invalid.',
            'quantity_affected.min' => 'Quantity affected must be at least 1.',
        ];
    }
}