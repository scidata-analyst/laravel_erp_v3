<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Goods Receipt Note.
 */
class GrnStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'purchase_order_id' => ['required', 'integer', 'exists:purchase_orders,id'],
            'supplier_name' => ['required', 'string', 'max:255'],
            'grn_number' => ['required', 'string', 'max:50', 'unique:goods_receipt_notes,grn_number'],
            'receipt_date' => ['required', 'date'],
            'warehouse_id' => ['required', 'integer', 'exists:warehouses,id'],
            'notes' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'purchase_order_id.required' => 'The purchase order is required.',
            'purchase_order_id.exists' => 'The selected purchase order is invalid.',
            'supplier_name.required' => 'The supplier name is required.',
            'grn_number.required' => 'The GRN number is required.',
            'grn_number.unique' => 'The GRN number must be unique.',
            'receipt_date.required' => 'The receipt date is required.',
            'warehouse_id.required' => 'The warehouse is required.',
            'warehouse_id.exists' => 'The selected warehouse is invalid.',
        ];
    }
}