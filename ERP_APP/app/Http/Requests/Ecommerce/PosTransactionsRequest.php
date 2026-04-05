<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PosTransactionsRequest extends FormRequest
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
                'status' => 'nullable|in:completed,pending,refunded,cancelled',
                'payment_method' => 'nullable|in:cash,card,mobile,split',
                'search' => 'nullable|string'
            ];
        }

        return [
            'terminal_id' => 'required|exists:pos,id',
            'transaction_number' => 'required|string|max:50|unique:pos_transactions,transaction_number,' . $this->route('pos_transaction'),
            'transaction_type' => 'nullable|in:sale,return,refund',
            'amount' => 'nullable|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'tax_amount' => 'nullable|numeric|min:0',
            'customer_id' => 'nullable|exists:customers,id',
            'order_reference' => 'nullable|exists:sales_orders,id',
            'payment_method' => 'required|in:cash,card,mobile,split',
            'status' => 'required|in:completed,pending,refunded,cancelled',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:product_catalogs,id',
            'items.*.quantity' => 'nullable|integer|min:1',
            'items.*.qty' => 'nullable|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'cash_tendered' => 'nullable|numeric|min:0',
            'change_given' => 'nullable|numeric|min:0',
            'transaction_date' => 'nullable|date',
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
