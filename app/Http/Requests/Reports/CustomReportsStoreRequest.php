<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Custom Report.
 */
class CustomReportsStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'report_name' => ['required', 'string', 'max:255'],
            'module' => ['required', 'string', 'max:50'],
            'selected_fields' => ['required', 'string'],
            'filter_by' => ['nullable', 'string'],
            'schedule' => ['nullable', 'string', 'max:50'],
            'output_format' => ['required', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'report_name.required' => 'The report name is required.',
            'module.required' => 'The module is required.',
            'selected_fields.required' => 'The selected fields are required.',
            'output_format.required' => 'The output format is required.',
        ];
    }
}