<?php

namespace App\Http\Requests\Sales;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Customer record.
 */
class CustomersStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'contact_person' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'credit_limit' => ['required', 'numeric', 'min:0'],
            'sales_rep_id' => ['nullable', 'integer'],
            'billing_address' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'company_name.required' => 'The company name is required.',
            'contact_person.required' => 'The contact person is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'The phone number is required.',
            'credit_limit.required' => 'The credit limit is required.',
            'credit_limit.numeric' => 'Credit limit must be a numeric value.',
        ];
    }
}