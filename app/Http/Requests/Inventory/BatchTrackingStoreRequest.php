<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Batch Tracking record.
 */
class BatchTrackingStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'batch_lot_number' => ['required', 'string', 'max:100'],
            'serial_number' => ['nullable', 'string', 'max:100'],
            'quantity' => ['required', 'integer', 'min:0'],
            'manufacture_date' => ['nullable', 'date'],
            'expiry_date' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'The product is required.',
            'product_id.exists' => 'The selected product is invalid.',
            'batch_lot_number.required' => 'The batch lot number is required.',
            'quantity.required' => 'The quantity is required.',
            'quantity.integer' => 'Quantity must be an integer.',
        ];
    }
}