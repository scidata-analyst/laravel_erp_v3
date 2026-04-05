<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class GrnRequest extends FormRequest
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
                'status' => 'nullable|string|in:pending,verified,rejected',
                'grn_number' => 'nullable|string'
            ];
        }

        return [
            'grn_number' => 'nullable|string|max:50|unique:grns,grn_number,' . ($this->route('id') ?? 'NULL') . ',id',
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'received_date' => 'required|date',
            'received_by' => 'nullable|exists:users,id',
            'total_items' => 'nullable|integer|min:0',
            'total_quantity' => 'nullable|integer|min:0',
            'status' => 'nullable|in:pending,completed,rejected',
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
