<?php

namespace App\Http\Requests\Reports;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Custom Report data.
 *
 * Validates fields based on the CustomReports model fillable attributes:
 * - report_name: required, string, max 100
 * - module: required, string, max 50
 * - selected_fields: nullable, string, max 1000
 * - filter_by: nullable, string, max 500
 * - schedule: nullable, string, max 50
 * - output_format: nullable, string, max 20
 */
class CustomReportsRequest extends FormRequest
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
        // Get the report ID for unique validation on updates
        $reportId = $this->route('custom_report');

        return [
            // Report name: required, string, max 100 characters
            'report_name' => ['required', 'string', 'max:100'],

            // Module: required, string, max 50 characters (e.g., sales, inventory, hr)
            'module' => ['required', 'string', 'max:50'],

            // Selected fields: optional, string, max 1000 characters (comma-separated field names)
            'selected_fields' => ['nullable', 'string', 'max:1000'],

            // Filter by: optional, string, max 500 characters
            'filter_by' => ['nullable', 'string', 'max:500'],

            // Schedule: optional, string, max 50 characters (e.g., daily, weekly, monthly)
            'schedule' => ['nullable', 'string', 'max:50'],

            // Output format: optional, string, max 20 characters (e.g., pdf, excel, csv)
            'output_format' => ['nullable', 'string', 'max:20'],
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
            'report_name.required' => 'The report name is required.',
            'report_name.max' => 'Report name must not exceed 100 characters.',
            'module.required' => 'The module is required.',
            'module.max' => 'Module must not exceed 50 characters.',
            'selected_fields.max' => 'Selected fields must not exceed 1000 characters.',
            'filter_by.max' => 'Filter by must not exceed 500 characters.',
            'schedule.max' => 'Schedule must not exceed 50 characters.',
            'output_format.max' => 'Output format must not exceed 20 characters.',
        ];
    }
}
