<?php

namespace Database\Factories\Logistics;

use App\Models\Logistics\Shipments;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Shipments>
 */
class ShipmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sales_order_id' => \App\Models\Sales\SalesOrders::factory(),
            'carrier' => fake()->randomElement(['DHL', 'FedEx', 'UPS', 'USPS', 'Local Courier']),
            'tracking_number' => fake()->unique()->bothify('TRK-####-????'),
            'estimated_delivery_date' => fake()->dateTimeBetween('now', '+2 weeks'),
            'shipping_address' => fake()->address(),
            'status' => fake()->randomElement(['Pending', 'Picked Up', 'In Transit', 'Out for Delivery', 'Delivered', 'Failed']),
        ];
    }
}
