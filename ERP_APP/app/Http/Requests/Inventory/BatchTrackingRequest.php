<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Batch Tracking data.
 *
 * Validates fields based on the BatchTracking model fillable attributes:
 * - product_id: required, exists in products table (foreign key relationship)
 * - batch_lot_number: required, string, unique in batch_tracking table
 * - serial_number: nullable, string, max 100
 * - quantity: required, integer, min 0
 * - manufacture_date: nullable, date
 * - expiry_date: nullable, date, must be after manufacture_date
 */
class BatchTrackingRequest extends FormRequest
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
        // Get the batch ID for unique validation on updates
        $batchId = $this->route('batch_tracking');

        return [
            // Product: required, must exist in products table
            'product_id' => ['required', 'exists:App\Models\Inventory\ProductCatalog,id'],

            // Batch/lot number: required, string, max 100 characters, unique in batch_tracking
            'batch_lot_number' => [
                'required',
                'string',
                'max:100',
                "unique:batch_tracking,batch_lot_number,{$batchId},id",
            ],

            // Serial number: optional, string, max 100 characters
            'serial_number' => ['nullable', 'string', 'max:100'],

            // Quantity: required, integer, must be 0 or greater
            'quantity' => ['required', 'integer', 'min:0'],

            // Manufacture date: optional, must be a valid date
            'manufacture_date' => ['nullable', 'date'],

            // Expiry date: optional, must be a valid date after manufacture_date
            'expiry_date' => ['nullable', 'date', 'after:manufacture_date'],
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
            'batch_lot_number.required' => 'The batch/lot number is required.',
            'batch_lot_number.max' => 'The batch/lot number must not exceed 100 characters.',
            'batch_lot_number.unique' => 'This batch/lot number is already in use.',
            'serial_number.max' => 'Serial number must not exceed 100 characters.',
            'quantity.required' => 'The quantity is required.',
            'quantity.integer' => 'Quantity must be an integer.',
            'quantity.min' => 'Quantity must be at least 0.',
            'manufacture_date.date' => 'Please enter a valid manufacture date.',
            'expiry_date.date' => 'Please enter a valid expiry date.',
            'expiry_date.after' => 'Expiry date must be after the manufacture date.',
        ];
    }
}
