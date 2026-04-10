<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Supplier Payment data.
 *
 * Validates fields based on the SupplierPayments model fillable attributes:
 * - supplier_id: required, exists in suppliers table (foreign key relationship)
 * - payment_number: required, string, unique in supplier_payments table
 * - invoice_reference: nullable, string, max 100
 * - amount: required, numeric, min 0
 * - payment_date: required, date
 * - payment_method: nullable, string, max 50
 * - status: nullable, string, max 50
 */
class SupplierPaymentsRequest extends FormRequest
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
        // Get the payment ID for unique validation on updates
        $paymentId = $this->route('supplier_payment');

        return [
            // Supplier: required, must exist in suppliers table
            'supplier_id' => ['required', 'exists:App\Models\Purchase\Suppliers,id'],

            // Payment number: required, string, max 50 characters, unique in supplier_payments
            'payment_number' => [
                'required',
                'string',
                'max:50',
                "unique:supplier_payments,payment_number,{$paymentId},id",
            ],

            // Invoice reference: optional, string, max 100 characters
            'invoice_reference' => ['nullable', 'string', 'max:100'],

            // Amount: required, numeric, must be 0 or greater
            'amount' => ['required', 'numeric', 'min:0'],

            // Payment date: required, must be a valid date
            'payment_date' => ['required', 'date'],

            // Payment method: optional, string, max 50 characters
            'payment_method' => ['nullable', 'string', 'max:50'],

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
            'supplier_id.required' => 'Please select a supplier.',
            'supplier_id.exists' => 'The selected supplier does not exist.',
            'payment_number.required' => 'The payment number is required.',
            'payment_number.max' => 'The payment number must not exceed 50 characters.',
            'payment_number.unique' => 'This payment number is already in use.',
            'invoice_reference.max' => 'Invoice reference must not exceed 100 characters.',
            'amount.required' => 'The payment amount is required.',
            'amount.numeric' => 'Amount must be a numeric value.',
            'amount.min' => 'Amount must be at least 0.',
            'payment_date.required' => 'The payment date is required.',
            'payment_date.date' => 'Please enter a valid date.',
            'payment_method.max' => 'Payment method must not exceed 50 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
