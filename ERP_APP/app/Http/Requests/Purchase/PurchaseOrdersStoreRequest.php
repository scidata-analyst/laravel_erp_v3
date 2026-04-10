<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Purchase Order.
 */
class PurchaseOrdersStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'po_number' => ['required', 'string', 'max:50', 'unique:purchase_orders,po_number'],
            'order_date' => ['required', 'date'],
            'expected_delivery_date' => ['nullable', 'date', 'after:order_date'],
            'warehouse_id' => ['required', 'integer', 'exists:warehouses,id'],
            'payment_terms' => ['nullable', 'string', 'max:100'],
            'total_amount' => ['required', 'numeric', 'min:0'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'supplier_id.required' => 'The supplier is required.',
            'supplier_id.exists' => 'The selected supplier is invalid.',
            'po_number.required' => 'The PO number is required.',
            'po_number.unique' => 'The PO number must be unique.',
            'order_date.required' => 'The order date is required.',
            'warehouse_id.required' => 'The warehouse is required.',
            'warehouse_id.exists' => 'The selected warehouse is invalid.',
            'total_amount.required' => 'The total amount is required.',
            'expected_delivery_date.after' => 'Delivery date must be after order date.',
        ];
    }
}