<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\BatchTracking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BatchTracking>
 */
class BatchTrackingFactory extends Factory
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
            'batch_lot_number' => fake()->unique()->bothify('BATCH-####-??'),
            'serial_number' => fake()->optional()->unique()->isbn10(),
            'quantity' => fake()->numberBetween(1, 500),
            'manufacture_date' => fake()->dateTimeBetween('-2 years', '-1 month'),
            'expiry_date' => fake()->dateTimeBetween('+1 month', '+2 years'),
        ];
    }
}
