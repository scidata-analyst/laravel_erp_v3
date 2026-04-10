<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Tax configuration record.
 */
class TaxStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tax_name' => ['required', 'string', 'max:255'],
            'tax_type' => ['required', 'string', 'max:50'],
            'rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'filing_period' => ['required', 'string', 'max:50'],
            'applicable_on' => ['required', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'tax_name.required' => 'The tax name is required.',
            'tax_type.required' => 'The tax type is required.',
            'rate.required' => 'The tax rate is required.',
            'rate.numeric' => 'Rate must be a numeric value.',
            'rate.min' => 'Rate must be at least 0.',
            'rate.max' => 'Rate must not exceed 100.',
            'filing_period.required' => 'The filing period is required.',
            'applicable_on.required' => 'The applicable on field is required.',
        ];
    }
}