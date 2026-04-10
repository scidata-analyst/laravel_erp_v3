<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Financial Report data.
 *
 * Validates fields based on the FinReports model fillable attributes:
 * - type: required, string, max 50
 * - period: required, string, max 50
 * - start_date: required, date
 * - end_date: required, date, must be after start_date
 * - format: nullable, string, max 20
 */
class FinReportsRequest extends FormRequest
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
        $reportId = $this->route('fin_report');

        return [
            // Report type: required, string, max 50 characters (e.g., balance_sheet, income_statement)
            'type' => ['required', 'string', 'max:50'],

            // Period: required, string, max 50 characters (e.g., Q1 2024, 2024)
            'period' => ['required', 'string', 'max:50'],

            // Start date: required, must be a valid date
            'start_date' => ['required', 'date'],

            // End date: required, must be a valid date after start_date
            'end_date' => ['required', 'date', 'after:start_date'],

            // Format: optional, string, max 20 characters (e.g., pdf, excel, html)
            'format' => ['nullable', 'string', 'max:20'],
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
            'type.required' => 'The report type is required.',
            'type.max' => 'Report type must not exceed 50 characters.',
            'period.required' => 'The period is required.',
            'period.max' => 'Period must not exceed 50 characters.',
            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'Please enter a valid date.',
            'end_date.required' => 'The end date is required.',
            'end_date.date' => 'Please enter a valid date.',
            'end_date.after' => 'End date must be after the start date.',
            'format.max' => 'Format must not exceed 20 characters.',
        ];
    }
}
