<?php

namespace Database\Factories\Ecommerce;

use App\Models\Ecommerce\Pos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pos>
 */
class PosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'terminal_id' => fake()->unique()->numerify('POS-####'),
            'location' => fake()->randomElement(['Store Front', 'Warehouse', 'Branch Office', 'Pop-up Shop']),
            'assigned_cashier_id' => \App\Models\UsersRoles\User::factory(),
            'warehouse_id' => \App\Models\Logistics\Warehouses::factory(),
            'receipt_printer' => fake()->randomElement(['Printer A', 'Printer B', 'No Printer']),
            'status' => fake()->randomElement(['Active', 'Inactive', 'Under Maintenance']),
        ];
    }
}
