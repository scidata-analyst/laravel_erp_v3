<?php

namespace Database\Factories;

use App\Models\Logistics\Routes;
use App\Models\Logistics\Shipments;
use App\Models\Sales\SalesOrders;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Shipments>
 */
class ShipmentsFactory extends Factory
{
    protected $model = Shipments::class;

    public function definition(): array
    {
        return [
            'shipment_number' => 'SHP-' . Str::upper(fake()->unique()->bothify('######')),
            'sales_order_id' => SalesOrders::query()->inRandomOrder()->value('id'),
            'customer' => fake()->company(),
            'carrier' => fake()->randomElement(['DHL', 'FedEx', 'UPS', 'Local Courier']),
            'tracking_number' => strtoupper(fake()->bothify('TRK########')),
            'est_delivery_date' => fake()->dateTimeBetween('now', '+15 days'),
            'actual_delivery_date' => fake()->optional()->dateTimeBetween('-10 days', 'now'),
            'status' => fake()->randomElement(['pending', 'in_transit', 'delivered']),
            'shipping_address' => fake()->address(),
            'cost' => fake()->randomFloat(2, 20, 1500),
            'notes' => fake()->optional()->sentence(),
            'route_id' => fake()->boolean(50) ? Routes::query()->inRandomOrder()->value('id') : null,
        ];
    }
}
