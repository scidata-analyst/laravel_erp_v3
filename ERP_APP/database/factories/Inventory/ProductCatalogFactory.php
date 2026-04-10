<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\ProductCatalog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductCatalog>
 */
class ProductCatalogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => fake()->words(3, true),
            'sku' => fake()->unique()->bothify('SKU-####-??'),
            'category' => fake()->randomElement(['Electronics', 'Furniture', 'Clothing', 'Food', 'Tools', 'Office']),
            'unit_price' => fake()->randomFloat(2, 10, 5000),
            'cost_price' => fake()->randomFloat(2, 5, 2500),
            'warehouse_id' => \App\Models\Logistics\Warehouses::factory(),
            'reorder_level' => fake()->numberBetween(10, 100),
            'valuation_method' => fake()->randomElement(['FIFO', 'LIFO', 'Weighted Average']),
            'description' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(['Active', 'Inactive', 'Discontinued']),
        ];
    }
}
