<?php

namespace App\Http\Requests\Sales;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Invoice.
 */
class InvoicesUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $invoiceId = $this->route('invoice');
        return [
            'customer_id' => ['sometimes', 'integer', 'exists:customers,id'],
            'invoice_number' => ['sometimes', 'string', 'max:50', 'unique:invoices,invoice_number,' . $invoiceId],
            'sales_order_ref' => ['nullable', 'string', 'max:50'],
            'invoice_date' => ['sometimes', 'date'],
            'due_date' => ['sometimes', 'date'],
            'amount' => ['sometimes', 'numeric', 'min:0'],
            'tax_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'notes' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.exists' => 'The selected customer is invalid.',
            'invoice_number.unique' => 'The invoice number must be unique.',
            'tax_percentage.max' => 'Tax cannot exceed 100%.',
        ];
    }
}