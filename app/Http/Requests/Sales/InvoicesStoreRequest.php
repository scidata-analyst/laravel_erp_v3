<?php

namespace App\Http\Requests\Sales;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Invoice.
 */
class InvoicesStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'invoice_number' => ['required', 'string', 'max:50', 'unique:invoices,invoice_number'],
            'sales_order_ref' => ['nullable', 'string', 'max:50'],
            'invoice_date' => ['required', 'date'],
            'due_date' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'min:0'],
            'tax_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'notes' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'The customer is required.',
            'customer_id.exists' => 'The selected customer is invalid.',
            'invoice_number.required' => 'The invoice number is required.',
            'invoice_number.unique' => 'The invoice number must be unique.',
            'invoice_date.required' => 'The invoice date is required.',
            'due_date.required' => 'The due date is required.',
            'amount.required' => 'The invoice amount is required.',
            'tax_percentage.max' => 'Tax cannot exceed 100%.',
        ];
    }
}