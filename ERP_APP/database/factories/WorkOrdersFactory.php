<?php

namespace Database\Factories;

use App\Models\HR\Employees;
use App\Models\Production\Bom;
use App\Models\Production\WorkOrders;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<WorkOrders>
 */
class WorkOrdersFactory extends Factory
{
    protected $model = WorkOrders::class;

    public function definition(): array
    {
        $qty = fake()->numberBetween(10, 300);
        $produced = fake()->numberBetween(0, $qty);

        return [
            'wo_number' => 'WO-' . Str::upper(fake()->unique()->bothify('######')),
            'product_bom_id' => Bom::query()->inRandomOrder()->value('id'),
            'qty_to_produce' => $qty,
            'priority' => fake()->randomElement(['low', 'normal', 'high', 'urgent']),
            'start_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'end_date' => fake()->dateTimeBetween('now', '+1 month'),
            'assigned_to' => Employees::query()->inRandomOrder()->value('id'),
            'status' => fake()->randomElement(['pending', 'in_progress', 'completed', 'cancelled']),
            'actual_qty_produced' => $produced,
            'scrap_quantity' => fake()->numberBetween(0, 20),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
