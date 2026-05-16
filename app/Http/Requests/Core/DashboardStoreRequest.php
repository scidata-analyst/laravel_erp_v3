<?php

namespace App\Http\Requests\Core;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Dashboard record.
 */
class DashboardStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'total_revenue' => ['required', 'numeric', 'min:0'],
            'sales_orders' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'total_revenue.required' => 'The total revenue is required.',
            'total_revenue.numeric' => 'Total revenue must be a numeric value.',
            'sales_orders.required' => 'The sales orders count is required.',
            'sales_orders.integer' => 'Sales orders must be an integer.',
        ];
    }
}