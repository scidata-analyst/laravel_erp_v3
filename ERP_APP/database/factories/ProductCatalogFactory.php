<?php

namespace Database\Factories;

use App\Models\Ecommerce\OnlineChannels;
use App\Models\Inventory\ProductCatalog;
use App\Models\Logistics\Warehouses;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ProductCatalog>
 */
class ProductCatalogFactory extends Factory
{
    protected $model = ProductCatalog::class;

    public function definition(): array
    {
        $cost = fake()->randomFloat(2, 10, 500);
        $price = $cost + fake()->randomFloat(2, 5, 250);

        return [
            'product_name' => fake()->words(3, true),
            'sku' => 'SKU-' . Str::upper(fake()->unique()->bothify('??###')),
            'category' => fake()->randomElement(['Electronics', 'Apparel', 'Home', 'Food', 'Accessories']),
            'unit_price' => $price,
            'cost_price' => $cost,
            'warehouse' => Warehouses::query()->inRandomOrder()->value('code'),
            'reorder_level' => fake()->numberBetween(5, 50),
            'valuation_method' => fake()->randomElement(['FIFO', 'LIFO', 'Weighted Average']),
            'description' => fake()->sentence(),
            'status' => fake()->randomElement(['active', 'inactive']),
            'barcode' => fake()->ean13(),
            'weight' => fake()->randomFloat(2, 0.1, 25),
            'dimensions' => fake()->numberBetween(5, 100) . 'x' . fake()->numberBetween(5, 100) . 'x' . fake()->numberBetween(5, 100) . ' cm',
            'channel_id' => OnlineChannels::query()->inRandomOrder()->value('id'),
        ];
    }
}
