<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Supplier data.
 *
 * Validates fields based on the Suppliers model fillable attributes:
 * - company_name: required, string, max 255
 * - contact_person: required, string, max 255
 * - email: required, email, unique in suppliers table
 * - phone: nullable, string, max 20
 * - country: nullable, string, max 100
 * - payment_terms: nullable, string, max 100
 * - currency: nullable, string, max 10
 * - address: nullable, string, max 500
 * - status: nullable, string, max 50
 */
class SuppliersRequest extends FormRequest
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
        // Get the supplier ID for unique validation on updates
        $supplierId = $this->route('supplier');

        return [
            // Company name: required, string, max 255 characters
            'company_name' => ['required', 'string', 'max:255'],

            // Contact person: required, string, max 255 characters
            'contact_person' => ['required', 'string', 'max:255'],

            // Email: required, valid email format, unique in suppliers table
            'email' => [
                'required',
                'email',
                'max:255',
                "unique:suppliers,email,{$supplierId},id",
            ],

            // Phone: optional, string, max 20 characters
            'phone' => ['nullable', 'string', 'max:20'],

            // Country: optional, string, max 100 characters
            'country' => ['nullable', 'string', 'max:100'],

            // Payment terms: optional, string, max 100 characters
            'payment_terms' => ['nullable', 'string', 'max:100'],

            // Currency: optional, string, max 10 characters
            'currency' => ['nullable', 'string', 'max:10'],

            // Address: optional, string, max 500 characters
            'address' => ['nullable', 'string', 'max:500'],

            // Status: optional, string, max 50 characters
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
            'company_name.required' => 'The company name is required.',
            'company_name.max' => 'The company name must not exceed 255 characters.',
            'contact_person.required' => 'The contact person name is required.',
            'contact_person.max' => 'The contact person name must not exceed 255 characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'phone.max' => 'The phone number must not exceed 20 characters.',
            'country.max' => 'Country must not exceed 100 characters.',
            'payment_terms.max' => 'Payment terms must not exceed 100 characters.',
            'currency.max' => 'Currency must not exceed 10 characters.',
            'address.max' => 'Address must not exceed 500 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
