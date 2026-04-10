<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Product Catalog entry.
 */
class ProductCatalogUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product_catalog');
        return [
            'product_name' => ['sometimes', 'string', 'max:255'],
            'sku' => ['sometimes', 'string', 'max:100', 'unique:products,sku,' . $productId],
            'category' => ['sometimes', 'string', 'max:100'],
            'unit_price' => ['sometimes', 'numeric', 'min:0'],
            'cost_price' => ['sometimes', 'numeric', 'min:0'],
            'warehouse_id' => ['sometimes', 'integer', 'exists:warehouses,id'],
            'reorder_level' => ['nullable', 'integer', 'min:0'],
            'valuation_method' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'sku.unique' => 'The SKU must be unique.',
            'warehouse_id.exists' => 'The selected warehouse is invalid.',
            'unit_price.numeric' => 'Unit price must be a numeric value.',
            'cost_price.numeric' => 'Cost price must be a numeric value.',
        ];
    }
}