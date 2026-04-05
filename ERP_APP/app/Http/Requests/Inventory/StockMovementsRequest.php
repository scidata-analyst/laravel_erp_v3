<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StockMovementsRequest extends FormRequest
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
                'movement_type' => 'nullable|in:Stock In,Stock Out,Transfer,Adjustment',
            ];
        }

        return [
            'ref_number' => 'nullable|string|max:50|unique:stock_movements,ref_number,' . ($this->route('stock_movement') ?? 'NULL') . ',id',
            'date' => 'nullable|date',
            'product_id' => 'required|exists:product_catalogs,id',
            'movement_type' => 'required|in:Stock In,Stock Out,Transfer,Adjustment',
            'quantity' => 'required|integer|min:1',
            'from_warehouse' => 'nullable|exists:warehouses,code',
            'to_warehouse' => 'nullable|exists:warehouses,code',
            'reason_notes' => 'nullable|string|max:1000',
            'user_id' => 'nullable|exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'ref_number.required' => 'Reference number is required',
            'ref_number.unique' => 'Reference number already exists',
            'date.required' => 'Date is required',
            'date.date' => 'Date must be a valid date',
            'product_id.required' => 'Product is required',
            'product_id.exists' => 'Selected product does not exist',
            'movement_type.required' => 'Movement type is required',
            'movement_type.in' => 'Movement type must be one of: Stock In, Stock Out, Transfer, Adjustment',
            'quantity.required' => 'Quantity is required',
            'quantity.integer' => 'Quantity must be an integer',
            'quantity.min' => 'Quantity must be at least 1',
            'from_warehouse.exists' => 'Source warehouse does not exist',
            'to_warehouse.exists' => 'Destination warehouse does not exist',
            'user_id.required' => 'User is required',
            'user_id.exists' => 'Selected user does not exist'
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
