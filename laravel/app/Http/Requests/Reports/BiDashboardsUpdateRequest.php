<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing BI Dashboard.
 */
class BiDashboardsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'widget_name' => ['sometimes', 'string', 'max:255'],
            'chart_type' => ['sometimes', 'string', 'max:50'],
            'data_source_module' => ['sometimes', 'string', 'max:50'],
            'refresh_rate' => ['sometimes', 'integer', 'min:1'],
            'dashboard_name' => ['sometimes', 'string', 'max:255'],
            'created_by_user_id' => ['nullable', 'integer'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'refresh_rate.min' => 'Refresh rate must be at least 1 minute.',
        ];
    }
}