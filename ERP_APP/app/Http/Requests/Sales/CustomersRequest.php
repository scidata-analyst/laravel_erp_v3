<?php

namespace App\Http\Requests\Sales;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Customer data.
 *
 * Validates fields based on the Customers model fillable attributes:
 * - company_name: required, string, max 255
 * - contact_person: required, string, max 255
 * - email: required, email, unique in customers table
 * - phone: nullable, string, max 20
 * - credit_limit: nullable, numeric, min 0
 * - sales_rep_id: nullable, exists in users table (foreign key relationship)
 * - billing_address: nullable, string, max 500
 */
class CustomersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Should be updated to check proper authentication/authorization.
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
        // Get the customer ID for unique validation on updates
        $customerId = $this->route('customer');

        return [
            // Company name: required, string, max 255 characters
            'company_name' => ['required', 'string', 'max:255'],

            // Contact person: required, string, max 255 characters
            'contact_person' => ['required', 'string', 'max:255'],

            // Email: required, valid email format, unique in customers table
            'email' => [
                'required',
                'email',
                'max:255',
                // Unique rule ignores current record when updating
                "unique:customers,email,{$customerId},id",
            ],

            // Phone: optional, string, max 20 characters
            'phone' => ['nullable', 'string', 'max:20'],

            // Credit limit: optional, numeric, must be 0 or greater
            'credit_limit' => ['nullable', 'numeric', 'min:0'],

            // Sales representative: optional, must exist in users table
            'sales_rep_id' => ['nullable', 'exists:App\Models\UsersRoles\User,id'],

            // Billing address: optional, string, max 500 characters
            'billing_address' => ['nullable', 'string', 'max:500'],
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
            'credit_limit.numeric' => 'The credit limit must be a numeric value.',
            'credit_limit.min' => 'The credit limit must be at least 0.',
            'sales_rep_id.exists' => 'The selected sales representative does not exist.',
            'billing_address.max' => 'The billing address must not exceed 500 characters.',
        ];
    }
}
