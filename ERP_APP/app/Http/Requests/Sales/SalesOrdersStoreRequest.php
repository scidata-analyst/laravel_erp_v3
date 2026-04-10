<?php

namespace App\Http\Requests\Sales;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Sales Order.
 */
class SalesOrdersStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'order_number' => ['required', 'string', 'max:50', 'unique:sales_orders,order_number'],
            'order_date' => ['required', 'date'],
            'delivery_date' => ['nullable', 'date'],
            'payment_terms' => ['nullable', 'string', 'max:100'],
            'discount_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'total_amount' => ['required', 'numeric', 'min:0'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'The customer is required.',
            'customer_id.exists' => 'The selected customer is invalid.',
            'order_number.required' => 'The order number is required.',
            'order_number.unique' => 'The order number must be unique.',
            'order_date.required' => 'The order date is required.',
            'total_amount.required' => 'The total amount is required.',
            'discount_percentage.max' => 'Discount cannot exceed 100%.',
        ];
    }
}