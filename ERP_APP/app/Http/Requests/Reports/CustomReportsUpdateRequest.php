<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Custom Report.
 */
class CustomReportsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'report_name' => ['sometimes', 'string', 'max:255'],
            'module' => ['sometimes', 'string', 'max:50'],
            'selected_fields' => ['sometimes', 'string'],
            'filter_by' => ['nullable', 'string'],
            'schedule' => ['nullable', 'string', 'max:50'],
            'output_format' => ['sometimes', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}