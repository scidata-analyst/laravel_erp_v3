<?php

namespace App\Http\Requests\Core;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Dashboard data.
 *
 * Validates fields based on the Dashboard model fillable attributes:
 * - total_revenue: nullable, numeric, min 0
 * - sales_orders: nullable, integer, min 0
 */
class DashboardRequest extends FormRequest
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
        // Get the dashboard ID for unique validation on updates
        $dashboardId = $this->route('dashboard');

        return [
            // Total revenue: optional, numeric, must be 0 or greater
            'total_revenue' => ['nullable', 'numeric', 'min:0'],

            // Sales orders: optional, integer, must be 0 or greater
            'sales_orders' => ['nullable', 'integer', 'min:0'],
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
            'total_revenue.numeric' => 'Total revenue must be a numeric value.',
            'total_revenue.min' => 'Total revenue must be at least 0.',
            'sales_orders.integer' => 'Sales orders must be an integer.',
            'sales_orders.min' => 'Sales orders must be at least 0.',
        ];
    }
}
