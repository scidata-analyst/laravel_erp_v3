<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StockValuationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('GET')) {
            return [
                'per_page' => 'nullable|integer|min:1|max:100',
                'product_id' => 'nullable|exists:product_catalogs,id',
            ];
        }

        return [
            'product_id' => 'required|exists:product_catalogs,id',
            'warehouse_id' => 'nullable|exists:warehouses,id',
            'valuation_date' => 'required|date',
            'valuation_method' => 'required|in:FIFO,LIFO,Weighted Average',
            'quantity_on_hand' => 'required|numeric|min:0',
            'unit_cost' => 'required|numeric|min:0',
            'total_value' => 'required|numeric|min:0',
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
