<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Tax configuration record.
 */
class TaxUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tax_name' => ['sometimes', 'string', 'max:255'],
            'tax_type' => ['sometimes', 'string', 'max:50'],
            'rate' => ['sometimes', 'numeric', 'min:0', 'max:100'],
            'filing_period' => ['sometimes', 'string', 'max:50'],
            'applicable_on' => ['sometimes', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'rate.numeric' => 'Rate must be a numeric value.',
            'rate.min' => 'Rate must be at least 0.',
            'rate.max' => 'Rate must not exceed 100.',
        ];
    }
}