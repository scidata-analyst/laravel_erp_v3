<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Batch Tracking record.
 */
class BatchTrackingUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $batchId = $this->input('id') ?? $this->route('id');
        return [
            'product_id' => ['sometimes', 'integer', 'exists:products,id'],
            'batch_lot_number' => ['sometimes', 'string', 'max:100'],
            'serial_number' => ['nullable', 'string', 'max:100', 'unique:batch_tracking,serial_number,' . $batchId . ',id'],
            'quantity' => ['sometimes', 'integer', 'min:0'],
            'manufacture_date' => ['nullable', 'date'],
            'expiry_date' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.exists' => 'The selected product is invalid.',
            'quantity.integer' => 'Quantity must be an integer.',
            'serial_number.unique' => 'The serial number must be unique.',
        ];
    }
}