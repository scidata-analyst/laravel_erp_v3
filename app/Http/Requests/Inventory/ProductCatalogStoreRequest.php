<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Product Catalog entry.
 */
class ProductCatalogStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:100', 'unique:products,sku'],
            'category' => ['required', 'string', 'max:100'],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'cost_price' => ['required', 'numeric', 'min:0'],
            'warehouse_id' => ['required', 'integer', 'exists:warehouses,id'],
            'reorder_level' => ['nullable', 'integer', 'min:0'],
            'valuation_method' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_name.required' => 'The product name is required.',
            'sku.required' => 'The SKU is required.',
            'sku.unique' => 'The SKU must be unique.',
            'category.required' => 'The category is required.',
            'unit_price.required' => 'The unit price is required.',
            'unit_price.numeric' => 'Unit price must be a numeric value.',
            'cost_price.required' => 'The cost price is required.',
            'cost_price.numeric' => 'Cost price must be a numeric value.',
            'warehouse_id.required' => 'The warehouse is required.',
            'warehouse_id.exists' => 'The selected warehouse is invalid.',
            'reorder_level.integer' => 'Reorder level must be an integer.',
        ];
    }
}