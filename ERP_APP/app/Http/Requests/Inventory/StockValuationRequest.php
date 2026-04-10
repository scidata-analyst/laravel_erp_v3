<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Stock Valuation data.
 *
 * Validates fields based on the StockValuation model fillable attributes:
 * - product_id: required, exists in products table (foreign key relationship)
 * - valuation_method: nullable, string, max 50
 * - unit_cost: required, numeric, min 0
 * - quantity_on_hand: required, numeric, min 0
 * - total_value: required, numeric, min 0
 */
class StockValuationRequest extends FormRequest
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
        // Get the stock valuation ID for unique validation on updates
        $valuationId = $this->route('stock_valuation');

        return [
            // Product: required, must exist in products table
            'product_id' => [
                'required',
                'exists:App\Models\Inventory\ProductCatalog,id',
                // Unique in stock_valuation table (one valuation per product)
                "unique:stock_valuation,product_id,{$valuationId},id",
            ],

            // Valuation method: optional, string, max 50 characters
            'valuation_method' => ['nullable', 'string', 'max:50'],

            // Unit cost: required, numeric, must be 0 or greater
            'unit_cost' => ['required', 'numeric', 'min:0'],

            // Quantity on hand: required, numeric, must be 0 or greater
            'quantity_on_hand' => ['required', 'numeric', 'min:0'],

            // Total value: required, numeric, must be 0 or greater
            'total_value' => ['required', 'numeric', 'min:0'],
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
            'product_id.unique' => 'A valuation record for this product already exists.',
            'valuation_method.max' => 'Valuation method must not exceed 50 characters.',
            'unit_cost.required' => 'The unit cost is required.',
            'unit_cost.numeric' => 'Unit cost must be a numeric value.',
            'unit_cost.min' => 'Unit cost must be at least 0.',
            'quantity_on_hand.required' => 'The quantity on hand is required.',
            'quantity_on_hand.numeric' => 'Quantity must be a numeric value.',
            'quantity_on_hand.min' => 'Quantity must be at least 0.',
            'total_value.required' => 'The total value is required.',
            'total_value.numeric' => 'Total value must be a numeric value.',
            'total_value.min' => 'Total value must be at least 0.',
        ];
    }
}
