<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BatchTrackingRequest extends FormRequest
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
                'status' => 'nullable|in:available,reserved,expired,quarantine',
                'days' => 'nullable|integer|min:1',
            ];
        }

        return [
            'batch_lot_number' => 'required|string|max:100',
            'serial_number' => 'nullable|string|max:100',
            'product_id' => 'required|exists:product_catalogs,id',
            'quantity' => 'required|integer|min:1',
            'manufacturing_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:manufacturing_date',
            'status' => 'required|in:available,reserved,expired,quarantine',
            'warehouse_location' => 'nullable|exists:warehouses,code',
            'cost_per_unit' => 'required|numeric|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'batch_lot_number.required' => 'Batch/Lot number is required',
            'product_id.required' => 'Product is required',
            'product_id.exists' => 'Selected product does not exist',
            'quantity.required' => 'Quantity is required',
            'quantity.integer' => 'Quantity must be an integer',
            'quantity.min' => 'Quantity must be at least 1',
            'manufacturing_date.required' => 'Manufacturing date is required',
            'manufacturing_date.date' => 'Manufacturing date must be a valid date',
            'expiry_date.after' => 'Expiry date must be after manufacturing date',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of: available, reserved, expired, quarantine',
            'cost_per_unit.required' => 'Cost per unit is required',
            'cost_per_unit.numeric' => 'Cost per unit must be a number',
            'cost_per_unit.min' => 'Cost per unit must be at least 0'
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
