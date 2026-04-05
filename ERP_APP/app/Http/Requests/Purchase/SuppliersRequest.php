<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SuppliersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('get')) {
            return [
                'per_page' => 'nullable|integer|min:1|max:100',
                'status' => 'nullable|string|in:active,inactive',
                'search' => 'nullable|string'
            ];
        }

        return [
            'company_name' => 'required_without:name|string|max:255|unique:suppliers,company_name,' . $this->route('supplier'),
            'name' => 'required_without:company_name|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:suppliers,email,' . $this->route('supplier'),
            'phone' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'payment_terms' => 'required|in:Net 30,Net 60,Net 90,Prepaid',
            'currency' => 'required|string|size:3',
            'address' => 'required|string|max:1000',
            'status' => 'required|in:active,inactive',
            'rating' => 'nullable|integer|min:1|max:5',
            'tax_id' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'company_name.required' => 'Company name is required',
            'company_name.unique' => 'Company name already exists',
            'contact_person.required' => 'Contact person is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be valid',
            'email.unique' => 'Email already exists',
            'phone.required' => 'Phone number is required',
            'country.required' => 'Country is required',
            'payment_terms.required' => 'Payment terms are required',
            'payment_terms.in' => 'Payment terms must be one of: Net 30, Net 60, Net 90, Prepaid',
            'currency.required' => 'Currency is required',
            'currency.size' => 'Currency must be 3 characters',
            'address.required' => 'Address is required',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of: active, inactive',
            'rating.integer' => 'Rating must be an integer',
            'rating.min' => 'Rating must be at least 1',
            'rating.max' => 'Rating must not be more than 5'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}
