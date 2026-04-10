<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Tax data.
 *
 * Validates fields based on the Tax model fillable attributes:
 * - tax_name: required, string, max 100
 * - tax_type: required, string, max 50
 * - rate: required, numeric, between 0 and 100
 * - filing_period: nullable, string, max 50
 * - applicable_on: nullable, string, max 100
 * - status: nullable, string, max 50
 */
class TaxRequest extends FormRequest
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
        // Get the tax ID for unique validation on updates
        $taxId = $this->route('tax');

        return [
            // Tax name: required, string, max 100 characters
            'tax_name' => ['required', 'string', 'max:100'],

            // Tax type: required, string, max 50 characters (e.g., vat, gst, sales, income)
            'tax_type' => ['required', 'string', 'max:50'],

            // Rate: required, numeric, between 0 and 100
            'rate' => ['required', 'numeric', 'min:0', 'max:100'],

            // Filing period: optional, string, max 50 characters (e.g., monthly, quarterly)
            'filing_period' => ['nullable', 'string', 'max:50'],

            // Applicable on: optional, string, max 100 characters
            'applicable_on' => ['nullable', 'string', 'max:100'],

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
            'tax_name.required' => 'The tax name is required.',
            'tax_name.max' => 'Tax name must not exceed 100 characters.',
            'tax_type.required' => 'The tax type is required.',
            'tax_type.max' => 'Tax type must not exceed 50 characters.',
            'rate.required' => 'The tax rate is required.',
            'rate.numeric' => 'Tax rate must be a numeric value.',
            'rate.min' => 'Tax rate must be at least 0.',
            'rate.max' => 'Tax rate must not exceed 100.',
            'filing_period.max' => 'Filing period must not exceed 50 characters.',
            'applicable_on.max' => 'Applicable on must not exceed 100 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
