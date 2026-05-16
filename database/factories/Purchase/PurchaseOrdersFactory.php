<?php

namespace Database\Factories\Purchase;

use App\Models\Purchase\PurchaseOrders;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PurchaseOrders>
 */
class PurchaseOrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supplier_id' => \App\Models\Purchase\Suppliers::factory(),
            'po_number' => fake()->unique()->numerify('PO-#####'),
            'order_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'expected_delivery_date' => fake()->dateTimeBetween('now', '+2 months'),
            'warehouse_id' => \App\Models\Logistics\Warehouses::factory(),
            'payment_terms' => fake()->randomElement(['Net 30', 'Net 60', 'Net 90', 'Prepayment']),
            'total_amount' => fake()->randomFloat(2, 100, 50000),
            'status' => fake()->randomElement(['Pending', 'Approved', 'Ordered', 'Received', 'Cancelled']),
        ];
    }
}
