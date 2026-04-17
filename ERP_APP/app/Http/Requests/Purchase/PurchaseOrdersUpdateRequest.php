<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Purchase Order.
 */
class PurchaseOrdersUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $poId = $this->route('id') ?? $this->input('id');
        return [
            'supplier_id' => ['sometimes', 'integer', 'exists:suppliers,id'],
            'po_number' => ['sometimes', 'string', 'max:50', 'unique:purchase_orders,po_number,' . $poId],
            'order_date' => ['sometimes', 'date'],
            'expected_delivery_date' => ['nullable', 'date'],
            'warehouse_id' => ['sometimes', 'integer', 'exists:warehouses,id'],
            'payment_terms' => ['nullable', 'string', 'max:100'],
            'total_amount' => ['sometimes', 'numeric', 'min:0'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'supplier_id.exists' => 'The selected supplier is invalid.',
            'po_number.unique' => 'The PO number must be unique.',
            'warehouse_id.exists' => 'The selected warehouse is invalid.',
        ];
    }
}