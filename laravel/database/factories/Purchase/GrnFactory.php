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
            'supplier_name' => $this->faker->company(),
            'grn_number' => $this->faker->unique()->numerify('GRN-#####'),
            'receipt_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'warehouse_id' => \App\Models\Logistics\Warehouses::factory(),
            'notes' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['Pending', 'Received', 'Verified', 'Cancelled']),
        ];
    }
}
