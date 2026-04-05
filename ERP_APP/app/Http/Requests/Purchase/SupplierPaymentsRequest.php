<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SupplierPaymentsRequest extends FormRequest
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
                'status' => 'nullable|string|in:pending,completed,failed',
                'supplier_id' => 'nullable|integer'
            ];
        }

        return [
            'payment_number' => 'nullable|string|max:100|unique:supplier_payments,payment_number,' . ($this->route('id') ?? 'NULL') . ',id',
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_order_id' => 'nullable|exists:purchase_orders,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:Bank Transfer,Cash,Check,Credit Card,Cheque',
            'reference_number' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:255',
            'status' => 'nullable|in:pending,completed,failed',
            'approved_by' => 'nullable|exists:users,id',
            'notes' => 'nullable|string|max:1000',
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
