<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PurchaseOrdersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('get')) {
            return [
                'per_page' => 'nullable|integer|min:1|max:100',
                'status' => 'nullable|string|in:pending,approved,received,cancelled',
                'supplier_id' => 'nullable|integer'
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'po_number' => 'nullable|string|max:50|unique:purchase_orders,po_number,' . $this->route('id'),
                'supplier_id' => 'required|exists:suppliers,id',
                'order_date' => 'required|date',
                'expected_delivery' => 'nullable|date|after_or_equal:order_date',
                'warehouse' => 'nullable|exists:warehouses,code',
                'payment_terms' => 'nullable|in:Advance,Net 15,Net 30,Net 45,Net 60,Net 90,Prepaid',
                'total_amount' => 'nullable|numeric|min:0',
                'status' => 'required|in:pending,approved,received,cancelled,Draft,Pending,Approved,Received',
                'approved_by' => 'nullable|exists:users,id',
                'order_items' => 'nullable|array',
                'order_items.*.product_id' => 'nullable|exists:product_catalogs,id',
                'order_items.*.product_name' => 'nullable|string|max:255',
                'order_items.*.qty' => 'nullable|integer|min:1',
                'order_items.*.quantity' => 'nullable|integer|min:1',
                'order_items.*.unit_cost' => 'nullable|numeric|min:0',
                'order_items.*.line_total' => 'nullable|numeric|min:0',
                'order_items.*.total' => 'nullable|numeric|min:0',
                'notes' => 'nullable|string|max:1000'
            ];
        }

        return [
            'po_number' => 'required|string|max:50|unique:purchase_orders,po_number,' . $this->route('purchase_order'),
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'expected_delivery' => 'required|date|after_or_equal:order_date',
            'warehouse' => 'required|exists:warehouses,code',
            'payment_terms' => 'required|in:Advance,Net 15,Net 30,Net 45,Net 60,Net 90,Prepaid',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,approved,received,cancelled',
            'approved_by' => 'nullable|exists:users,id',
            'order_items' => 'required|array|min:1',
            'order_items.*.product_id' => 'nullable|exists:product_catalogs,id',
            'order_items.*.product_name' => 'nullable|string|max:255',
            'order_items.*.qty' => 'nullable|integer|min:1',
            'order_items.*.quantity' => 'nullable|integer|min:1',
            'order_items.*.unit_cost' => 'required|numeric|min:0',
            'order_items.*.line_total' => 'nullable|numeric|min:0',
            'order_items.*.total' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000'
        ];
    }

    public function messages(): array
    {
        return [
            'po_number.required' => 'Purchase order number is required',
            'po_number.unique' => 'Purchase order number already exists',
            'supplier_id.required' => 'Supplier is required',
            'supplier_id.exists' => 'Selected supplier does not exist',
            'order_date.required' => 'Order date is required',
            'expected_delivery.required' => 'Expected delivery date is required',
            'expected_delivery.after_or_equal' => 'Expected delivery must be after or equal to order date',
            'warehouse.required' => 'Warehouse is required',
            'warehouse.exists' => 'Selected warehouse does not exist',
            'payment_terms.required' => 'Payment terms are required',
            'payment_terms.in' => 'Payment terms must be one of: Net 30, Net 60, Net 90, Prepaid',
            'total_amount.required' => 'Total amount is required',
            'total_amount.numeric' => 'Total amount must be a number',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of: draft, sent, approved, rejected, completed',
            'approved_by.exists' => 'Selected approver does not exist',
            'order_items.required' => 'Order items are required',
            'order_items.min' => 'At least one order item is required'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}
