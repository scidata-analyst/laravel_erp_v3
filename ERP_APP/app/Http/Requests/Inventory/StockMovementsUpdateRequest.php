<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Stock Movement record.
 */
class StockMovementsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['sometimes', 'integer', 'exists:products,id'],
            'movement_type' => ['sometimes', 'string', 'max:50'],
            'quantity' => ['sometimes', 'integer', 'min:0'],
            'from_warehouse_id' => ['nullable', 'integer', 'exists:warehouses,id'],
            'to_warehouse_id' => ['nullable', 'integer', 'exists:warehouses,id'],
            'reason' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.exists' => 'The selected product is invalid.',
            'quantity.integer' => 'Quantity must be an integer.',
            'from_warehouse_id.exists' => 'The source warehouse is invalid.',
            'to_warehouse_id.exists' => 'The destination warehouse is invalid.',
        ];
    }
}