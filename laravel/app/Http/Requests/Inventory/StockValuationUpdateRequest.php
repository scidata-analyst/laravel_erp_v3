<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Stock Valuation record.
 */
class StockValuationUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $valuationId = $this->input('id') ?? $this->route('id');
        return [
            'product_id' => ['sometimes', 'integer', 'exists:products,id'],
            'valuation_method' => ['sometimes', 'string', 'max:50'],
            'unit_cost' => ['sometimes', 'numeric', 'min:0'],
            'quantity_on_hand' => ['sometimes', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.exists' => 'The selected product is invalid.',
            'unit_cost.numeric' => 'Unit cost must be a numeric value.',
            'quantity_on_hand.integer' => 'Quantity must be an integer.',
        ];
    }
}