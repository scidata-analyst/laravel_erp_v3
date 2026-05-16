<?php

namespace App\Http\Requests\QualityControl;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Defect record.
 */
class DefectsStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'batch_lot_number' => ['nullable', 'string', 'max:100'],
            'defect_type' => ['required', 'string', 'max:50'],
            'severity' => ['required', 'string', 'max:20'],
            'quantity_affected' => ['required', 'integer', 'min:1'],
            'description_root_cause' => ['required', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'The product is required.',
            'product_id.exists' => 'The selected product is invalid.',
            'defect_type.required' => 'The defect type is required.',
            'severity.required' => 'The severity is required.',
            'quantity_affected.required' => 'The quantity affected is required.',
            'quantity_affected.min' => 'Quantity affected must be at least 1.',
            'description_root_cause.required' => 'The description is required.',
        ];
    }
}