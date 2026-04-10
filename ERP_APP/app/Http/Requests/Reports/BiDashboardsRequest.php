<?php

namespace App\Http\Requests\Reports;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating BI Dashboard data.
 *
 * Validates fields based on the BiDashboards model fillable attributes:
 * - widget_name: required, string, max 100
 * - chart_type: required, string, max 50
 * - data_source_module: required, string, max 50
 * - refresh_rate: nullable, integer, min 1
 * - dashboard_name: nullable, string, max 100
 * - created_by_user_id: nullable, exists in users table (foreign key relationship)
 * - status: nullable, string, max 50
 */
class BiDashboardsRequest extends FormRequest
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
        $dashboardId = $this->route('bi_dashboard');

        return [
            // Widget name: required, string, max 100 characters
            'widget_name' => ['required', 'string', 'max:100'],

            // Chart type: required, string, max 50 characters (e.g., bar, line, pie)
            'chart_type' => ['required', 'string', 'max:50'],

            // Data source module: required, string, max 50 characters (e.g., sales, inventory)
            'data_source_module' => ['required', 'string', 'max:50'],

            // Refresh rate: optional, integer, must be at least 1 (in minutes)
            'refresh_rate' => ['nullable', 'integer', 'min:1'],

            // Dashboard name: optional, string, max 100 characters
            'dashboard_name' => ['nullable', 'string', 'max:100'],

            // Created by user: optional, must exist in users table
            'created_by_user_id' => ['nullable', 'exists:App\Models\UsersRoles\User,id'],

            // Status: optional, string, max 50 characters (e.g., active, inactive)
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
            'widget_name.required' => 'The widget name is required.',
            'widget_name.max' => 'Widget name must not exceed 100 characters.',
            'chart_type.required' => 'The chart type is required.',
            'chart_type.max' => 'Chart type must not exceed 50 characters.',
            'data_source_module.required' => 'The data source module is required.',
            'data_source_module.max' => 'Data source module must not exceed 50 characters.',
            'refresh_rate.integer' => 'Refresh rate must be an integer.',
            'refresh_rate.min' => 'Refresh rate must be at least 1 minute.',
            'dashboard_name.max' => 'Dashboard name must not exceed 100 characters.',
            'created_by_user_id.exists' => 'The selected user does not exist.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
