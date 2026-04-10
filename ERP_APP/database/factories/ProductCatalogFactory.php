<?php

namespace Database\Factories;

use App\Models\Inventory\ProductCatalog;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCatalogFactory extends Factory
{
    protected $model = ProductCatalog::class;

    public function definition(): array
    {
        return [
            'product_name' => fake()->unique()->words(3, true),
            'sku' => fake()->unique()->bothify('SKU-####'),
            'category' => fake()->randomElement(['Electronics', 'Furniture', 'Clothing', 'Food', 'Equipment']),
            'unit_price' => fake()->randomFloat(2, 10, 1000),
            'cost_price' => fake()->randomFloat(2, 5, 500),
            'warehouse_id' => null,
            'reorder_level' => fake()->numberBetween(10, 100),
            'valuation_method' => 'fifo',
            'description' => fake()->sentence(),
            'status' => 'active',
        ];
    }
}
