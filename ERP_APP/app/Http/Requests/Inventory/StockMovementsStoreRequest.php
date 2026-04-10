<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Stock Movement record.
 */
class StockMovementsStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'movement_type' => ['required', 'string', 'max:50'],
            'quantity' => ['required', 'integer', 'min:0'],
            'from_warehouse_id' => ['nullable', 'integer', 'exists:warehouses,id'],
            'to_warehouse_id' => ['nullable', 'integer', 'exists:warehouses,id'],
            'reason' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'The product is required.',
            'product_id.exists' => 'The selected product is invalid.',
            'movement_type.required' => 'The movement type is required.',
            'quantity.required' => 'The quantity is required.',
            'quantity.integer' => 'Quantity must be an integer.',
            'from_warehouse_id.exists' => 'The source warehouse is invalid.',
            'to_warehouse_id.exists' => 'The destination warehouse is invalid.',
        ];
    }
}