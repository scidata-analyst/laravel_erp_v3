<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Supplier record.
 */
class SuppliersStoreRequest extends FormRequest
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
            'country' => ['required', 'string', 'max:100'],
            'payment_terms' => ['nullable', 'string', 'max:100'],
            'currency' => ['nullable', 'string', 'max:10'],
            'address' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
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
            'country.required' => 'The country is required.',
        ];
    }
}