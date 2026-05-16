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
            'carrier' => $this->faker->randomElement(['DHL', 'FedEx', 'UPS', 'USPS', 'Local Courier']),
            'tracking_number' => $this->faker->unique()->bothify('TRK-####-????'),
            'estimated_delivery_date' => $this->faker->dateTimeBetween('now', '+2 weeks'),
            'shipping_address' => $this->faker->address(),
            'status' => $this->faker->randomElement(['Pending', 'Picked Up', 'In Transit', 'Out for Delivery', 'Delivered', 'Failed']),
        ];
    }
}
