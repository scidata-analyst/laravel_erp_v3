<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\StockValuation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockValuation>
 */
class StockValuationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => \App\Models\Inventory\ProductCatalog::factory(),
            'valuation_method' => $this->faker->randomElement(['FIFO', 'LIFO', 'Weighted Average']),
            'unit_cost' => $this->faker->randomFloat(2, 5, 1000),
            'quantity_on_hand' => $this->faker->numberBetween(10, 1000),
            'total_value' => $this->faker->randomFloat(2, 100, 100000),
        ];
    }
}
