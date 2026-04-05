<?php

namespace Database\Factories;

use App\Models\Inventory\ProductCatalog;
use App\Models\Inventory\StockMovements;
use App\Models\Logistics\Warehouses;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<StockMovements>
 */
class StockMovementsFactory extends Factory
{
    protected $model = StockMovements::class;

    public function definition(): array
    {
        $movementType = fake()->randomElement(['Stock In', 'Stock Out', 'Transfer', 'Adjustment']);
        $fromWarehouse = Warehouses::query()->inRandomOrder()->value('code');
        $toWarehouse = Warehouses::query()->where('code', '!=', $fromWarehouse)->inRandomOrder()->value('code');

        return [
            'ref_number' => 'SM-' . Str::upper(fake()->unique()->bothify('######')),
            'date' => fake()->dateTimeBetween('-3 months', 'now'),
            'product_id' => ProductCatalog::query()->inRandomOrder()->value('id'),
            'movement_type' => $movementType,
            'quantity' => fake()->numberBetween(1, 100),
            'from_warehouse' => in_array($movementType, ['Stock Out', 'Transfer'], true) ? $fromWarehouse : null,
            'to_warehouse' => in_array($movementType, ['Stock In', 'Transfer'], true) ? ($toWarehouse ?? $fromWarehouse) : null,
            'reason_notes' => fake()->sentence(),
            'user_id' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
