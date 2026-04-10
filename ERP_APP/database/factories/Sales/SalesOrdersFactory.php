<?php

namespace Database\Factories\Sales;

use App\Models\Sales\SalesOrders;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SalesOrders>
 */
class SalesOrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => \App\Models\Sales\Customers::factory(),
            'order_number' => fake()->unique()->numerify('SO-#####'),
            'order_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'delivery_date' => fake()->dateTimeBetween('now', '+1 month'),
            'payment_terms' => fake()->randomElement(['Net 30', 'Net 60', 'Net 90', 'Due on Receipt']),
            'discount_percentage' => fake()->randomFloat(2, 0, 20),
            'total_amount' => fake()->randomFloat(2, 100, 10000),
            'status' => fake()->randomElement(['Pending', 'Confirmed', 'Processing', 'Shipped', 'Delivered', 'Cancelled']),
        ];
    }
}
