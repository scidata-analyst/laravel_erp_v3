<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Product Catalog data.
 *
 * Validates fields based on the ProductCatalog model fillable attributes:
 * - product_name: required, string, max 255
 * - sku: required, string, unique in products table
 * - category: nullable, string, max 100
 * - unit_price: required, numeric, min 0
 * - cost_price: nullable, numeric, min 0
 * - warehouse_id: nullable, exists in warehouses table (foreign key relationship)
 * - reorder_level: nullable, integer, min 0
 * - valuation_method: nullable, string, max 50
 * - description: nullable, string, max 1000
 * - status: nullable, string, max 50
 */
class ProductCatalogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the product ID for unique validation on updates
        $productId = $this->route('product');

        return [
            // Product name: required, string, max 255 characters
            'product_name' => ['required', 'string', 'max:255'],

            // SKU: required, string, max 100 characters, unique in products
            'sku' => [
                'required',
                'string',
                'max:100',
                "unique:products,sku,{$productId},id",
            ],

            // Category: optional, string, max 100 characters
            'category' => ['nullable', 'string', 'max:100'],

            // Unit price: required, numeric, must be 0 or greater
            'unit_price' => ['required', 'numeric', 'min:0'],

            // Cost price: optional, numeric, must be 0 or greater
            'cost_price' => ['nullable', 'numeric', 'min:0'],

            // Warehouse: optional, must exist in warehouses table
            'warehouse_id' => ['nullable', 'exists:App\Models\Logistics\Warehouses,id'],

            // Reorder level: optional, integer, must be 0 or greater
            'reorder_level' => ['nullable', 'integer', 'min:0'],

            // Valuation method: optional, string, max 50 characters
            'valuation_method' => ['nullable', 'string', 'max:50'],

            // Description: optional, string, max 1000 characters
            'description' => ['nullable', 'string', 'max:1000'],

            // Status: optional, string, max 50 characters
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'product_name.required' => 'The product name is required.',
            'product_name.max' => 'The product name must not exceed 255 characters.',
            'sku.required' => 'The SKU is required.',
            'sku.max' => 'The SKU must not exceed 100 characters.',
            'sku.unique' => 'This SKU is already in use.',
            'category.max' => 'Category must not exceed 100 characters.',
            'unit_price.required' => 'The unit price is required.',
            'unit_price.numeric' => 'Unit price must be a numeric value.',
            'unit_price.min' => 'Unit price must be at least 0.',
            'cost_price.numeric' => 'Cost price must be a numeric value.',
            'cost_price.min' => 'Cost price must be at least 0.',
            'warehouse_id.exists' => 'The selected warehouse does not exist.',
            'reorder_level.integer' => 'Reorder level must be an integer.',
            'reorder_level.min' => 'Reorder level must be at least 0.',
            'valuation_method.max' => 'Valuation method must not exceed 50 characters.',
            'description.max' => 'Description must not exceed 1000 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
