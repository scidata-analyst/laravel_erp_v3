<?php

namespace Database\Factories;

use App\Models\Inventory\ProductCatalog;
use App\Models\Purchase\Grn;
use App\Models\Purchase\GrnItems;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GrnItems>
 */
class GrnItemsFactory extends Factory
{
    protected $model = GrnItems::class;

    public function definition(): array
    {
        $product = ProductCatalog::query()->inRandomOrder()->first();
        $ordered = fake()->numberBetween(1, 50);
        $received = fake()->numberBetween(0, $ordered + 5);
        $unitPrice = (float) ($product?->cost_price ?? fake()->randomFloat(2, 5, 200));

        return [
            'grn_id' => Grn::query()->inRandomOrder()->value('id'),
            'product_name' => $product?->product_name ?? fake()->words(2, true),
            'sku' => $product?->sku ?? fake()->unique()->bothify('SKU-#####'),
            'quantity_ordered' => $ordered,
            'quantity_received' => $received,
            'unit_price' => $unitPrice,
            'total_value' => round($received * $unitPrice, 2),
            'batch_number' => fake()->optional()->bothify('BT-#####'),
            'expiry_date' => fake()->optional()->dateTimeBetween('+1 month', '+18 months'),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
