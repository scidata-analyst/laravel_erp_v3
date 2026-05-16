<?php

namespace App\Http\Requests\Sales;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Customer record.
 */
class CustomersUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => ['sometimes', 'string', 'max:255'],
            'contact_person' => ['sometimes', 'string', 'max:100'],
            'email' => ['sometimes', 'email', 'max:255'],
            'phone' => ['sometimes', 'string', 'max:50'],
            'credit_limit' => ['sometimes', 'numeric', 'min:0'],
            'sales_rep_id' => ['nullable', 'integer'],
            'billing_address' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Please enter a valid email address.',
            'credit_limit.numeric' => 'Credit limit must be a numeric value.',
        ];
    }
}