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
            'quantity_to_produce' => $this->faker->numberBetween(10, 1000),
            'priority' => $this->faker->randomElement(['Low', 'Medium', 'High', 'Urgent']),
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+2 months'),
            'workshop_line' => $this->faker->randomElement(['Line A', 'Line B', 'Line C']),
            'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed', 'Cancelled']),
        ];
    }
}
