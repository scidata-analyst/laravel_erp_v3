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
            'batch_lot_number' => $this->faker->unique()->bothify('BATCH-####-??'),
            'serial_number' => $this->faker->isbn10(),
            'quantity' => $this->faker->numberBetween(1, 500),
            'manufacture_date' => $this->faker->dateTimeBetween('-2 years', '-1 month'),
            'expiry_date' => $this->faker->dateTimeBetween('+1 month', '+2 years'),
        ];
    }
}
