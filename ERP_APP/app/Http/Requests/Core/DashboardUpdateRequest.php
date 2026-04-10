<?php

namespace App\Http\Requests\Core;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Dashboard record.
 */
class DashboardUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'total_revenue' => ['sometimes', 'numeric', 'min:0'],
            'sales_orders' => ['sometimes', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'total_revenue.numeric' => 'Total revenue must be a numeric value.',
            'sales_orders.integer' => 'Sales orders must be an integer.',
        ];
    }
}