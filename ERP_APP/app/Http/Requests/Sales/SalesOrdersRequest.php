<?php

namespace App\Http\Requests\Sales;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Sales Order data.
 *
 * Validates fields based on the SalesOrders model fillable attributes:
 * - customer_id: required, exists in customers table (foreign key relationship)
 * - order_number: required, string, unique in sales_orders table
 * - order_date: required, date
 * - delivery_date: nullable, date, must be after or equal to order_date
 * - payment_terms: nullable, string, max 100
 * - discount_percentage: nullable, numeric, between 0 and 100
 * - total_amount: required, numeric, min 0
 * - status: nullable, string, max 50
 */
class SalesOrdersRequest extends FormRequest
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
        // Get the sales order ID for unique validation on updates
        $orderId = $this->route('sales_order');

        return [
            // Customer: required, must exist in customers table
            'customer_id' => ['required', 'exists:App\Models\Sales\Customers,id'],

            // Order number: required, string, max 50 characters, unique in sales_orders
            'order_number' => [
                'required',
                'string',
                'max:50',
                "unique:sales_orders,order_number,{$orderId},id",
            ],

            // Order date: required, must be a valid date
            'order_date' => ['required', 'date'],

            // Delivery date: optional, must be a valid date
            'delivery_date' => ['nullable', 'date', 'after_or_equal:order_date'],

            // Payment terms: optional, string, max 100 characters
            'payment_terms' => ['nullable', 'string', 'max:100'],

            // Discount percentage: optional, numeric, between 0 and 100
            'discount_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],

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
            'customer_id.required' => 'Please select a customer.',
            'customer_id.exists' => 'The selected customer does not exist.',
            'order_number.required' => 'The order number is required.',
            'order_number.max' => 'The order number must not exceed 50 characters.',
            'order_number.unique' => 'This order number is already in use.',
            'order_date.required' => 'The order date is required.',
            'order_date.date' => 'Please enter a valid date.',
            'delivery_date.date' => 'Please enter a valid delivery date.',
            'delivery_date.after_or_equal' => 'Delivery date must be on or after the order date.',
            'payment_terms.max' => 'Payment terms must not exceed 100 characters.',
            'discount_percentage.numeric' => 'Discount percentage must be a numeric value.',
            'discount_percentage.min' => 'Discount percentage must be at least 0.',
            'discount_percentage.max' => 'Discount percentage must not exceed 100.',
            'total_amount.required' => 'The total amount is required.',
            'total_amount.numeric' => 'Total amount must be a numeric value.',
            'total_amount.min' => 'Total amount must be at least 0.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
