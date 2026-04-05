<?php

namespace Database\Factories;

use App\Models\Inventory\BatchTracking;
use App\Models\Inventory\ProductCatalog;
use App\Models\Logistics\Warehouses;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<BatchTracking>
 */
class BatchTrackingFactory extends Factory
{
    protected $model = BatchTracking::class;

    public function definition(): array
    {
        $mfgDate = fake()->dateTimeBetween('-1 year', '-1 month');

        return [
            'batch_lot_number' => 'LOT-' . Str::upper(fake()->unique()->bothify('######')),
            'serial_number' => 'SER-' . Str::upper(fake()->unique()->bothify('########')),
            'product_id' => ProductCatalog::query()->inRandomOrder()->value('id'),
            'quantity' => fake()->numberBetween(1, 200),
            'manufacturing_date' => $mfgDate,
            'expiry_date' => fake()->dateTimeBetween($mfgDate, '+2 years'),
            'status' => fake()->randomElement(['available', 'reserved', 'expired']),
            'warehouse_location' => Warehouses::query()->inRandomOrder()->value('code'),
            'cost_per_unit' => fake()->randomFloat(2, 5, 300),
        ];
    }
}
