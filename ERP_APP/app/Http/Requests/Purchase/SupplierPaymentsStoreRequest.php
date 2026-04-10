<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Supplier Payment record.
 */
class SupplierPaymentsStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'payment_number' => ['required', 'string', 'max:50', 'unique:supplier_payments,payment_number'],
            'invoice_reference' => ['nullable', 'string', 'max:100'],
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_date' => ['required', 'date'],
            'payment_method' => ['required', 'string', 'max:50'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'supplier_id.required' => 'The supplier is required.',
            'supplier_id.exists' => 'The selected supplier is invalid.',
            'payment_number.required' => 'The payment number is required.',
            'payment_number.unique' => 'The payment number must be unique.',
            'amount.required' => 'The payment amount is required.',
            'amount.numeric' => 'Amount must be a numeric value.',
            'payment_date.required' => 'The payment date is required.',
            'payment_method.required' => 'The payment method is required.',
        ];
    }
}