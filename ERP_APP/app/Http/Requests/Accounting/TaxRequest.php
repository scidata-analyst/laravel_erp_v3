<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TaxRequest extends FormRequest
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
                'tax_type' => 'nullable|in:Sales Tax,VAT,Income Tax,Property Tax',
                'status' => 'nullable|in:active,inactive,archived'
            ];
        }

        return [
            'tax_name' => 'nullable|string|max:255|required_without:name',
            'name' => 'nullable|string|max:255|required_without:tax_name',
            'tax_rate' => 'nullable|numeric|min:0|max:100|required_without:rate',
            'rate' => 'nullable|numeric|min:0|max:100|required_without:tax_rate',
            'tax_type' => 'nullable|in:Sales Tax,VAT,Income Tax,Property Tax|required_without:type',
            'type' => 'nullable|in:Sales Tax,VAT,Income Tax,Property Tax|required_without:tax_type',
            'applicable_to' => 'nullable|in:All Products,Specific Categories,Services',
            'description' => 'nullable|string|max:1000',
            'effective_date' => 'nullable|date',
            'status' => 'required|in:active,inactive,archived,Active,Inactive,Archived',
            'tax_code' => 'nullable|string|max:20',
            'jurisdiction' => 'nullable|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'tax_name.required' => 'Tax name is required',
            'tax_rate.required' => 'Tax rate is required',
            'tax_rate.numeric' => 'Tax rate must be a number',
            'tax_rate.max' => 'Tax rate must not be more than 100',
            'tax_type.required' => 'Tax type is required',
            'tax_type.in' => 'Tax type must be one of: Sales Tax, VAT, Income Tax, Property Tax',
            'applicable_to.required' => 'Applicable to is required',
            'applicable_to.in' => 'Applicable to must be one of: All Products, Specific Categories, Services',
            'effective_date.required' => 'Effective date is required',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of: active, inactive, archived',
            'jurisdiction.required' => 'Jurisdiction is required'
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
