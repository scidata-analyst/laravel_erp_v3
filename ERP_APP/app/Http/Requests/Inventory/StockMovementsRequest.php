<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Stock Movement data.
 *
 * Validates fields based on the StockMovements model fillable attributes:
 * - product_id: required, exists in products table (foreign key relationship)
 * - movement_type: required, string, in:in,out,transfer,adjustment
 * - quantity: required, integer, min 1
 * - from_warehouse_id: nullable, exists in warehouses table (foreign key relationship)
 * - to_warehouse_id: nullable, exists in warehouses table (foreign key relationship)
 * - reason: nullable, string, max 500
 */
class StockMovementsRequest extends FormRequest
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
        // Get the stock movement ID for unique validation on updates
        $movementId = $this->route('stock_movement');

        // Common rules for all movement types
        $rules = [
            // Product: required, must exist in products table
            'product_id' => ['required', 'exists:App\Models\Inventory\ProductCatalog,id'],

            // Movement type: required, must be one of the allowed types
            'movement_type' => ['required', 'string', 'in:in,out,transfer,adjustment'],

            // Quantity: required, integer, must be at least 1
            'quantity' => ['required', 'integer', 'min:1'],

            // From warehouse: optional, must exist in warehouses table
            'from_warehouse_id' => ['nullable', 'exists:App\Models\Logistics\Warehouses,id'],

            // To warehouse: optional, must exist in warehouses table
            'to_warehouse_id' => ['nullable', 'exists:App\Models\Logistics\Warehouses,id'],

            // Reason: optional, string, max 500 characters
            'reason' => ['nullable', 'string', 'max:500'],
        ];

        // For transfer type, both warehouses are required
        if ($this->input('movement_type') === 'transfer') {
            $rules['from_warehouse_id'] = ['required', 'exists:App\Models\Logistics\Warehouses,id'];
            $rules['to_warehouse_id'] = ['required', 'exists:App\Models\Logistics\Warehouses,id', 'different:from_warehouse_id'];
        }

        return $rules;
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
            'movement_type.required' => 'The movement type is required.',
            'movement_type.in' => 'Movement type must be one of: in, out, transfer, or adjustment.',
            'quantity.required' => 'The quantity is required.',
            'quantity.integer' => 'Quantity must be an integer.',
            'quantity.min' => 'Quantity must be at least 1.',
            'from_warehouse_id.required' => 'Please select a source warehouse for transfer.',
            'from_warehouse_id.exists' => 'The selected source warehouse does not exist.',
            'to_warehouse_id.required' => 'Please select a destination warehouse for transfer.',
            'to_warehouse_id.exists' => 'The selected destination warehouse does not exist.',
            'to_warehouse_id.different' => 'Source and destination warehouses must be different.',
            'reason.max' => 'Reason must not exceed 500 characters.',
        ];
    }
}
