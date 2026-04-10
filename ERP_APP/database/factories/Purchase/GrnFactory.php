<?php

namespace Database\Factories\Purchase;

use App\Models\Purchase\Grn;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Grn>
 */
class GrnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'purchase_order_id' => \App\Models\Purchase\PurchaseOrders::factory(),
            'supplier_name' => fake()->company(),
            'grn_number' => fake()->unique()->numerify('GRN-#####'),
            'receipt_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'warehouse_id' => \App\Models\Logistics\Warehouses::factory(),
            'notes' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(['Pending', 'Received', 'Verified', 'Cancelled']),
        ];
    }
}
