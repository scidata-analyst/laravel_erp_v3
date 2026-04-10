<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Purchase Order data.
 *
 * Validates fields based on the PurchaseOrders model fillable attributes:
 * - supplier_id: required, exists in suppliers table (foreign key relationship)
 * - po_number: required, string, unique in purchase_orders table
 * - order_date: required, date
 * - expected_delivery_date: nullable, date, must be after or equal to order_date
 * - warehouse_id: nullable, exists in warehouses table (foreign key relationship)
 * - payment_terms: nullable, string, max 100
 * - total_amount: required, numeric, min 0
 * - status: nullable, string, max 50
 */
class PurchaseOrdersRequest extends FormRequest
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
        // Get the purchase order ID for unique validation on updates
        $orderId = $this->route('purchase_order');

        return [
            // Supplier: required, must exist in suppliers table
            'supplier_id' => ['required', 'exists:App\Models\Purchase\Suppliers,id'],

            // PO number: required, string, max 50 characters, unique in purchase_orders
            'po_number' => [
                'required',
                'string',
                'max:50',
                "unique:purchase_orders,po_number,{$orderId},id",
            ],

            // Order date: required, must be a valid date
            'order_date' => ['required', 'date'],

            // Expected delivery date: optional, must be a valid date
            'expected_delivery_date' => ['nullable', 'date', 'after_or_equal:order_date'],

            // Warehouse: optional, must exist in warehouses table
            'warehouse_id' => ['nullable', 'exists:App\Models\Logistics\Warehouses,id'],

            // Payment terms: optional, string, max 100 characters
            'payment_terms' => ['nullable', 'string', 'max:100'],

            // Total amount: required, numeric, must be 0 or greater
            'total_amount' => ['required', 'numeric', 'min:0'],

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
            'supplier_id.required' => 'Please select a supplier.',
            'supplier_id.exists' => 'The selected supplier does not exist.',
            'po_number.required' => 'The PO number is required.',
            'po_number.max' => 'The PO number must not exceed 50 characters.',
            'po_number.unique' => 'This PO number is already in use.',
            'order_date.required' => 'The order date is required.',
            'order_date.date' => 'Please enter a valid date.',
            'expected_delivery_date.date' => 'Please enter a valid delivery date.',
            'expected_delivery_date.after_or_equal' => 'Expected delivery date must be on or after the order date.',
            'warehouse_id.exists' => 'The selected warehouse does not exist.',
            'payment_terms.max' => 'Payment terms must not exceed 100 characters.',
            'total_amount.required' => 'The total amount is required.',
            'total_amount.numeric' => 'Total amount must be a numeric value.',
            'total_amount.min' => 'Total amount must be at least 0.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
