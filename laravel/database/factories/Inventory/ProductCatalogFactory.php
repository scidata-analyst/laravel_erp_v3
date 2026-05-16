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
            'product_name' => $this->faker->words(3, true),
            'sku' => $this->faker->unique()->bothify('SKU-####-??'),
            'category' => $this->faker->randomElement(['Electronics', 'Furniture', 'Clothing', 'Food', 'Tools', 'Office']),
            'unit_price' => $this->faker->randomFloat(2, 10, 5000),
            'cost_price' => $this->faker->randomFloat(2, 5, 2500),
            'warehouse_id' => \App\Models\Logistics\Warehouses::factory(),
            'reorder_level' => $this->faker->numberBetween(10, 100),
            'valuation_method' => $this->faker->randomElement(['FIFO', 'LIFO', 'Weighted Average']),
            'description' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Discontinued']),
        ];
    }
}
