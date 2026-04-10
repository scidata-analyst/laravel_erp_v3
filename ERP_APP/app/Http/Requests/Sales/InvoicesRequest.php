<?php

namespace App\Http\Requests\Sales;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Invoice data.
 *
 * Validates fields based on the Invoices model fillable attributes:
 * - customer_id: required, exists in customers table (foreign key relationship)
 * - invoice_number: required, string, unique in invoices table
 * - sales_order_ref: nullable, string, max 50
 * - invoice_date: required, date
 * - due_date: nullable, date, must be after or equal to invoice_date
 * - amount: required, numeric, min 0
 * - tax_percentage: nullable, numeric, between 0 and 100
 * - notes: nullable, string, max 1000
 * - status: nullable, string, max 50
 */
class InvoicesRequest extends FormRequest
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
        // Get the invoice ID for unique validation on updates
        $invoiceId = $this->route('invoice');

        return [
            // Customer: required, must exist in customers table
            'customer_id' => ['required', 'exists:App\Models\Sales\Customers,id'],

            // Invoice number: required, string, max 50 characters, unique in invoices
            'invoice_number' => [
                'required',
                'string',
                'max:50',
                "unique:invoices,invoice_number,{$invoiceId},id",
            ],

            // Sales order reference: optional, string, max 50 characters
            'sales_order_ref' => ['nullable', 'string', 'max:50'],

            // Invoice date: required, must be a valid date
            'invoice_date' => ['required', 'date'],

            // Due date: optional, must be a valid date
            'due_date' => ['nullable', 'date', 'after_or_equal:invoice_date'],

            // Amount: required, numeric, must be 0 or greater
            'amount' => ['required', 'numeric', 'min:0'],

            // Tax percentage: optional, numeric, between 0 and 100
            'tax_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],

            // Notes: optional, string, max 1000 characters
            'notes' => ['nullable', 'string', 'max:1000'],

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
            'customer_id.required' => 'Please select a customer.',
            'customer_id.exists' => 'The selected customer does not exist.',
            'invoice_number.required' => 'The invoice number is required.',
            'invoice_number.max' => 'The invoice number must not exceed 50 characters.',
            'invoice_number.unique' => 'This invoice number is already in use.',
            'sales_order_ref.max' => 'Sales order reference must not exceed 50 characters.',
            'invoice_date.required' => 'The invoice date is required.',
            'invoice_date.date' => 'Please enter a valid invoice date.',
            'due_date.date' => 'Please enter a valid due date.',
            'due_date.after_or_equal' => 'Due date must be on or after the invoice date.',
            'amount.required' => 'The invoice amount is required.',
            'amount.numeric' => 'Amount must be a numeric value.',
            'amount.min' => 'Amount must be at least 0.',
            'tax_percentage.numeric' => 'Tax percentage must be a numeric value.',
            'tax_percentage.min' => 'Tax percentage must be at least 0.',
            'tax_percentage.max' => 'Tax percentage must not exceed 100.',
            'notes.max' => 'Notes must not exceed 1000 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
