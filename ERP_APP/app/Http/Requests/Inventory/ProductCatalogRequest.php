<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProductCatalogRequest extends FormRequest
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
                'category' => 'nullable|string',
                'status' => 'nullable|string',
            ];
        }

        return [
            'product_name' => 'required|string|max:255|unique:product_catalogs,product_name,' . ($this->route('product') ?? 'NULL') . ',id',
            'sku' => 'required|string|max:100|unique:product_catalogs,sku,' . ($this->route('product') ?? 'NULL') . ',id',
            'category' => 'required|string|max:100',
            'unit_price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'warehouse' => 'required|exists:warehouses,code',
            'reorder_level' => 'required|integer|min:0',
            'valuation_method' => 'required|in:FIFO,LIFO,Weighted Average',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:active,inactive,discontinued',
            'barcode' => 'nullable|string|max:100|unique:product_catalogs,barcode,' . ($this->route('product') ?? 'NULL') . ',id',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string|max:100'
        ];
    }

    public function messages(): array
    {
        return [
            'product_name.required' => 'Product name is required',
            'product_name.unique' => 'Product name already exists',
            'sku.required' => 'SKU is required',
            'sku.unique' => 'SKU already exists',
            'category.required' => 'Category is required',
            'unit_price.required' => 'Unit price is required',
            'unit_price.numeric' => 'Unit price must be a number',
            'cost_price.required' => 'Cost price is required',
            'cost_price.numeric' => 'Cost price must be a number',
            'warehouse.required' => 'Warehouse is required',
            'reorder_level.required' => 'Reorder level is required',
            'reorder_level.integer' => 'Reorder level must be an integer',
            'valuation_method.required' => 'Valuation method is required',
            'valuation_method.in' => 'Valuation method must be one of: FIFO, LIFO, Weighted Average',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of: active, inactive, discontinued'
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
