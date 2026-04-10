<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Financial Report.
 */
class FinReportsStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'max:100'],
            'period' => ['required', 'string', 'max:50'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'format' => ['required', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'The report type is required.',
            'period.required' => 'The reporting period is required.',
            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'Please enter a valid date.',
            'end_date.required' => 'The end date is required.',
            'end_date.date' => 'Please enter a valid date.',
            'end_date.after' => 'End date must be after start date.',
            'format.required' => 'The report format is required.',
        ];
    }
}