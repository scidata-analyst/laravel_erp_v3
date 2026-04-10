<?php

namespace App\Http\Requests\QualityControl;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Defect data.
 *
 * Validates fields based on the Defects model fillable attributes:
 * - product_id: required, exists in products table (foreign key relationship)
 * - batch_lot_number: nullable, string, max 100
 * - defect_type: required, string, max 50
 * - severity: required, string, max 50
 * - quantity_affected: required, integer, min 1
 * - description_root_cause: nullable, string, max 1000
 * - status: nullable, string, max 50
 */
class DefectsRequest extends FormRequest
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
        // Get the defect ID for unique validation on updates
        $defectId = $this->route('defect');

        return [
            // Product: required, must exist in products table
            'product_id' => ['required', 'exists:App\Models\Inventory\ProductCatalog,id'],

            // Batch/Lot number: optional, string, max 100 characters
            'batch_lot_number' => ['nullable', 'string', 'max:100'],

            // Defect type: required, string, max 50 characters (e.g., dimensional, functional, cosmetic)
            'defect_type' => ['required', 'string', 'max:50'],

            // Severity: required, string, max 50 characters (e.g., critical, major, minor)
            'severity' => ['required', 'string', 'max:50'],

            // Quantity affected: required, integer, must be at least 1
            'quantity_affected' => ['required', 'integer', 'min:1'],

            // Description/Root cause: optional, string, max 1000 characters
            'description_root_cause' => ['nullable', 'string', 'max:1000'],

            // Status: optional, string, max 50 characters (e.g., open, under_review, resolved)
            'status' => ['nullable', 'string', 'max:50'],
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
            'product_id.required' => 'Please select a product.',
            'product_id.exists' => 'The selected product does not exist.',
            'batch_lot_number.max' => 'Batch/lot number must not exceed 100 characters.',
            'defect_type.required' => 'The defect type is required.',
            'defect_type.max' => 'Defect type must not exceed 50 characters.',
            'severity.required' => 'The severity is required.',
            'severity.max' => 'Severity must not exceed 50 characters.',
            'quantity_affected.required' => 'The quantity affected is required.',
            'quantity_affected.integer' => 'Quantity affected must be an integer.',
            'quantity_affected.min' => 'Quantity affected must be at least 1.',
            'description_root_cause.max' => 'Description/root cause must not exceed 1000 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
