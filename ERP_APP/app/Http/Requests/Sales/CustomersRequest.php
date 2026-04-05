<?php

namespace App\Http\Requests\Sales;

use App\Traits\Validation\ValidationResponseTrait;
use App\Rules\Sales\CustomerStatusRule;
use App\Rules\Common\PaginationLimit;
use App\Rules\Common\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class CustomersRequest extends FormRequest
{
    use ValidationResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('get')) {
            return [
                'per_page' => ['nullable', new PaginationLimit],
                'search' => 'nullable|string|max:255',
                'status' => ['nullable', new CustomerStatusRule],
                'company_name' => 'nullable|string|max:255'
            ];
        }

        return [
            'company_name' => 'required_without:name|string|max:255|unique:customers,company_name,' . $this->route('customer'),
            'name' => 'required_without:company_name|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email,' . $this->route('customer'),
            'phone' => ['required', new PhoneNumber],
            'credit_limit' => 'required|numeric|min:0',
            'sales_rep' => 'nullable|string|max:255',
            'billing_address' => 'required|string|max:1000',
            'shipping_address' => 'nullable|string|max:1000',
            'status' => ['required', new CustomerStatusRule],
            'tax_id' => 'nullable|string|max:50',
            'payment_terms' => 'nullable|string|max:100'
        ];
    }

    public function messages(): array
    {
        return [
            'company_name.unique' => 'Company name already exists',
            'name.required_without' => 'Name is required when company name is missing',
            'email.unique' => 'Email already exists',
        ];
    }
}
