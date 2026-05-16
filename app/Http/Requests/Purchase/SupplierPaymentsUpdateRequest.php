<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Supplier Payment record.
 */
class SupplierPaymentsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $paymentId = $this->route('id') ?? $this->input('id');
        return [
            'supplier_id' => ['sometimes', 'integer', 'exists:suppliers,id'],
            'payment_number' => ['sometimes', 'string', 'max:50', 'unique:supplier_payments,payment_number,' . $paymentId],
            'invoice_reference' => ['nullable', 'string', 'max:100'],
            'amount' => ['sometimes', 'numeric', 'min:0'],
            'payment_date' => ['sometimes', 'date'],
            'payment_method' => ['sometimes', 'string', 'max:50'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'supplier_id.exists' => 'The selected supplier is invalid.',
            'payment_number.unique' => 'The payment number must be unique.',
            'amount.numeric' => 'Amount must be a numeric value.',
        ];
    }
}