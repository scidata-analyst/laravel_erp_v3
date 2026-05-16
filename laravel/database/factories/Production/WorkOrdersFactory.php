<?php

namespace Database\Factories\Production;

use App\Models\Production\WorkOrders;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkOrders>
 */
class WorkOrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bom_id' => \App\Models\Production\Bom::factory(),
            'quantity_to_produce' => fake()->numberBetween(10, 1000),
            'priority' => fake()->randomElement(['Low', 'Medium', 'High', 'Urgent']),
            'start_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'end_date' => fake()->dateTimeBetween('now', '+2 months'),
            'workshop_line' => fake()->randomElement(['Line A', 'Line B', 'Line C']),
            'status' => fake()->randomElement(['Pending', 'In Progress', 'Completed', 'Cancelled']),
        ];
    }
}
