<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new BI Dashboard.
 */
class BiDashboardsStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'widget_name' => ['required', 'string', 'max:255'],
            'chart_type' => ['required', 'string', 'max:50'],
            'data_source_module' => ['required', 'string', 'max:50'],
            'refresh_rate' => ['required', 'integer', 'min:1'],
            'dashboard_name' => ['required', 'string', 'max:255'],
            'created_by_user_id' => ['nullable', 'integer'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'widget_name.required' => 'The widget name is required.',
            'chart_type.required' => 'The chart type is required.',
            'data_source_module.required' => 'The data source module is required.',
            'refresh_rate.required' => 'The refresh rate is required.',
            'refresh_rate.min' => 'Refresh rate must be at least 1 minute.',
            'dashboard_name.required' => 'The dashboard name is required.',
        ];
    }
}