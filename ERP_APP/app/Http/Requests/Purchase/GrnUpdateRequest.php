<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Goods Receipt Note.
 */
class GrnUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $grnId = $this->route('grn');
        return [
            'purchase_order_id' => ['sometimes', 'integer', 'exists:purchase_orders,id'],
            'supplier_name' => ['sometimes', 'string', 'max:255'],
            'grn_number' => ['sometimes', 'string', 'max:50', 'unique:goods_receipt_notes,grn_number,' . $grnId],
            'receipt_date' => ['sometimes', 'date'],
            'warehouse_id' => ['sometimes', 'integer', 'exists:warehouses,id'],
            'notes' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'purchase_order_id.exists' => 'The selected purchase order is invalid.',
            'grn_number.unique' => 'The GRN number must be unique.',
            'warehouse_id.exists' => 'The selected warehouse is invalid.',
        ];
    }
}