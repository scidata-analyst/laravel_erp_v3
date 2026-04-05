<?php

namespace App\Http\Requests\Sales;

use App\Traits\Validation\ValidationResponseTrait;
use App\Rules\Sales\SalesOrderStatusRule;
use App\Rules\Sales\PaymentTermsRule;
use App\Rules\Common\PaginationLimit;
use Illuminate\Foundation\Http\FormRequest;

class SalesOrdersRequest extends FormRequest
{
    use ValidationResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('get')) {
            return [
                'per_page' => ['nullable', new PaginationLimit],
                'customer_id' => 'nullable|integer',
                'status' => ['nullable', new SalesOrderStatusRule],
                'so_number' => 'nullable|string'
            ];
        }

        return [
            'so_number' => 'nullable|string|max:50|unique:sales_orders,so_number,' . ($this->route('id') ?? 'NULL') . ',id',
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'delivery_date' => 'nullable|date|after_or_equal:order_date',
            'payment_terms' => ['nullable', new PaymentTermsRule],
            'discount' => 'nullable|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'status' => ['nullable', new SalesOrderStatusRule],
            'order_items' => 'nullable|array',
            'order_items.*.product_id' => 'nullable|exists:product_catalogs,id',
            'order_items.*.product_name' => 'nullable|string|max:255',
            'order_items.*.qty' => 'nullable|integer|min:1',
            'order_items.*.quantity' => 'nullable|integer|min:1',
            'order_items.*.unit_price' => 'nullable|numeric|min:0',
            'order_items.*.discount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000'
        ];
    }

    public function messages(): array
    {
        return [
            'so_number.unique' => 'Sales order number already exists',
            'customer_id.exists' => 'Selected customer does not exist',
            'delivery_date.after_or_equal' => 'Delivery date must be after or equal to order date'
        ];
    }
}
