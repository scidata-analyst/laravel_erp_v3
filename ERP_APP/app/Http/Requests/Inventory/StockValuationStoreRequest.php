<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Stock Valuation record.
 */
class StockValuationStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'valuation_method' => ['required', 'string', 'max:50'],
            'unit_cost' => ['required', 'numeric', 'min:0'],
            'quantity_on_hand' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'The product is required.',
            'product_id.exists' => 'The selected product is invalid.',
            'valuation_method.required' => 'The valuation method is required.',
            'unit_cost.required' => 'The unit cost is required.',
            'unit_cost.numeric' => 'Unit cost must be a numeric value.',
            'quantity_on_hand.required' => 'The quantity is required.',
            'quantity_on_hand.integer' => 'Quantity must be an integer.',
        ];
    }
}