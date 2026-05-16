<?php

namespace Database\Factories\Core;

use App\Models\Core\Dashboard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dashboard>
 */
class DashboardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total_revenue' => $this->faker->randomFloat(2, 10000, 1000000),
            'sales_orders' => $this->faker->numberBetween(10, 500),
        ];
    }
}
