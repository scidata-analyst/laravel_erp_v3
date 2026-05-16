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
            'product_name' => $this->faker->unique()->words(3, true),
            'sku' => $this->faker->unique()->bothify('SKU-####'),
            'category' => $this->faker->randomElement(['Electronics', 'Furniture', 'Clothing', 'Food', 'Equipment']),
            'unit_price' => $this->faker->randomFloat(2, 10, 1000),
            'cost_price' => $this->faker->randomFloat(2, 5, 500),
            'warehouse_id' => null,
            'reorder_level' => $this->faker->numberBetween(10, 100),
            'valuation_method' => 'fifo',
            'description' => $this->faker->sentence(),
            'status' => 'active',
        ];
    }
}
