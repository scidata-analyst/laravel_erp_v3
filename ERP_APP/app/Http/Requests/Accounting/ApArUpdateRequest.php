<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Accounts Payable/Receivable record.
 *
 * Validates the data for updating an existing AP/AR entry.
 * All fields are optional - only provided fields will be validated.
 */
class ApArUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|\Illuminate\Validation\Rule|string>
     */
    public function rules(): array
    {
        return [
            'party_name' => ['sometimes', 'string', 'max:255'],
            'ap_ar_type' => ['sometimes', 'string', 'in:AP,AR'],
            'amount' => ['sometimes', 'numeric', 'min:0'],
            'due_date' => ['nullable', 'date'],
            'reference' => ['nullable', 'string', 'max:100'],
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
            'party_name.max' => 'Party name must not exceed 255 characters.',
            'ap_ar_type.in' => 'Type must be either AP or AR.',
            'amount.numeric' => 'Amount must be a numeric value.',
            'amount.min' => 'Amount must be at least 0.',
            'due_date.date' => 'Please enter a valid date.',
            'reference.max' => 'Reference must not exceed 100 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}