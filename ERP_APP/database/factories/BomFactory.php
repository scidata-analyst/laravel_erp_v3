<?php

namespace Database\Factories;

use App\Models\Inventory\ProductCatalog;
use App\Models\Production\Bom;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Bom>
 */
class BomFactory extends Factory
{
    protected $model = Bom::class;

    public function definition(): array
    {
        $components = ProductCatalog::query()->inRandomOrder()->limit(fake()->numberBetween(2, 5))->get()->map(function ($product) {
            return [
                'product_id' => $product->id,
                'sku' => $product->sku,
                'name' => $product->product_name,
                'quantity' => fake()->numberBetween(1, 10),
            ];
        })->values()->all();

        return [
            'bom_number' => 'BOM-' . Str::upper(fake()->unique()->bothify('######')),
            'finished_product' => fake()->words(2, true),
            'version' => fake()->randomElement(['1.0', '1.1', '2.0']),
            'lead_time_days' => fake()->numberBetween(1, 20),
            'estimated_cost' => fake()->randomFloat(2, 100, 10000),
            'status' => fake()->randomElement(['draft', 'active', 'archived']),
            'components' => $components,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
