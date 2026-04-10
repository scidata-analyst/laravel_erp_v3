<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Goods Receipt Note (GRN) data.
 *
 * Validates fields based on the Grn model fillable attributes:
 * - purchase_order_id: required, exists in purchase_orders table (foreign key relationship)
 * - supplier_name: required, string, max 255
 * - grn_number: required, string, unique in goods_receipt_notes table
 * - receipt_date: required, date
 * - warehouse_id: required, exists in warehouses table (foreign key relationship)
 * - notes: nullable, string, max 500
 * - status: nullable, string, max 50
 */
class GrnRequest extends FormRequest
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
        // Get the GRN ID for unique validation on updates
        $grnId = $this->route('grn');

        return [
            // Purchase order: required, must exist in purchase_orders table
            'purchase_order_id' => ['required', 'exists:App\Models\Purchase\PurchaseOrders,id'],

            // Supplier name: required, string, max 255 characters
            'supplier_name' => ['required', 'string', 'max:255'],

            // GRN number: required, string, max 50 characters, unique in goods_receipt_notes
            'grn_number' => [
                'required',
                'string',
                'max:50',
                "unique:goods_receipt_notes,grn_number,{$grnId},id",
            ],

            // Receipt date: required, must be a valid date
            'receipt_date' => ['required', 'date'],

            // Warehouse: required, must exist in warehouses table
            'warehouse_id' => ['required', 'exists:App\Models\Logistics\Warehouses,id'],

            // Notes: optional, string, max 500 characters
            'notes' => ['nullable', 'string', 'max:500'],

            // Status: optional, string, max 50 characters
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
            'purchase_order_id.required' => 'Please select a purchase order.',
            'purchase_order_id.exists' => 'The selected purchase order does not exist.',
            'supplier_name.required' => 'The supplier name is required.',
            'supplier_name.max' => 'The supplier name must not exceed 255 characters.',
            'grn_number.required' => 'The GRN number is required.',
            'grn_number.max' => 'The GRN number must not exceed 50 characters.',
            'grn_number.unique' => 'This GRN number is already in use.',
            'receipt_date.required' => 'The receipt date is required.',
            'receipt_date.date' => 'Please enter a valid date.',
            'warehouse_id.required' => 'Please select a warehouse.',
            'warehouse_id.exists' => 'The selected warehouse does not exist.',
            'notes.max' => 'Notes must not exceed 500 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
