<?php

namespace App\Http\Requests\Sales;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Sales Order.
 */
class SalesOrdersUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $orderId = $this->route('sales_order');
        return [
            'customer_id' => ['sometimes', 'integer', 'exists:customers,id'],
            'order_number' => ['sometimes', 'string', 'max:50', 'unique:sales_orders,order_number,' . $orderId],
            'order_date' => ['sometimes', 'date'],
            'delivery_date' => ['nullable', 'date'],
            'payment_terms' => ['nullable', 'string', 'max:100'],
            'discount_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'total_amount' => ['sometimes', 'numeric', 'min:0'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.exists' => 'The selected customer is invalid.',
            'order_number.unique' => 'The order number must be unique.',
            'discount_percentage.max' => 'Discount cannot exceed 100%.',
        ];
    }
}