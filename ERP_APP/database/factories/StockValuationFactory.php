<?php

namespace Database\Factories;

use App\Models\Inventory\ProductCatalog;
use App\Models\Inventory\StockValuation;
use App\Models\Logistics\Warehouses;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockValuation>
 */
class StockValuationFactory extends Factory
{
    protected $model = StockValuation::class;

    public function definition(): array
    {
        $quantity = fake()->randomFloat(2, 1, 250);
        $unitCost = fake()->randomFloat(2, 5, 500);

        return [
            'valuation_date' => fake()->dateTimeBetween('-2 months', 'now'),
            'product_id' => ProductCatalog::query()->inRandomOrder()->value('id'),
            'warehouse_id' => Warehouses::query()->inRandomOrder()->value('id'),
            'quantity_on_hand' => $quantity,
            'unit_cost' => $unitCost,
            'total_value' => round($quantity * $unitCost, 2),
            'valuation_method' => fake()->randomElement(['FIFO', 'LIFO', 'Weighted Average']),
            'notes' => fake()->sentence(),
        ];
    }
}
