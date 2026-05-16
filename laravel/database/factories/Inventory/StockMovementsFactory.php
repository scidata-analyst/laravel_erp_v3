<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\StockMovements;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockMovements>
 */
class StockMovementsFactory extends Factory
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
            'movement_type' => $this->faker->randomElement(['Purchase', 'Sale', 'Transfer', 'Return', 'Adjustment']),
            'quantity' => $this->faker->numberBetween(1, 1000),
            'from_warehouse_id' => \App\Models\Logistics\Warehouses::factory(),
            'to_warehouse_id' => $this->faker->optional()->randomElement([\App\Models\Logistics\Warehouses::factory(), null]),
            'reason' => $this->faker->optional()->sentence(),
        ];
    }
}
