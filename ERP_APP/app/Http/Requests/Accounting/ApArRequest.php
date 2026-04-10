<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Accounts Payable/Receivable data.
 *
 * Validates fields based on the ApAr model fillable attributes:
 * - party_name: required, string, max 255
 * - ap_ar_type: required, string, in:AP,AR (Accounts Payable or Accounts Receivable)
 * - amount: required, numeric, min 0
 * - due_date: nullable, date
 * - reference: nullable, string, max 100
 * - status: nullable, string, max 50
 */
class ApArRequest extends FormRequest
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
        // Get the AP/AR ID for unique validation on updates
        $apArId = $this->route('ap_ar');

        return [
            // Party name: required, string, max 255 characters
            'party_name' => ['required', 'string', 'max:255'],

            // AP/AR type: required, must be either AP (Accounts Payable) or AR (Accounts Receivable)
            'ap_ar_type' => ['required', 'string', 'in:AP,AR'],

            // Amount: required, numeric, must be 0 or greater
            'amount' => ['required', 'numeric', 'min:0'],

            // Due date: optional, must be a valid date
            'due_date' => ['nullable', 'date'],

            // Reference: optional, string, max 100 characters
            'reference' => ['nullable', 'string', 'max:100'],

            // Status: optional, string, max 50 characters (e.g., pending, paid, overdue)
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
            'party_name.required' => 'The party name is required.',
            'party_name.max' => 'Party name must not exceed 255 characters.',
            'ap_ar_type.required' => 'The AP/AR type is required.',
            'ap_ar_type.in' => 'Type must be either AP (Accounts Payable) or AR (Accounts Receivable).',
            'amount.required' => 'The amount is required.',
            'amount.numeric' => 'Amount must be a numeric value.',
            'amount.min' => 'Amount must be at least 0.',
            'due_date.date' => 'Please enter a valid date.',
            'reference.max' => 'Reference must not exceed 100 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
