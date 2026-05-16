<?php

namespace Database\Factories\Logistics;

use App\Models\Logistics\Warehouses;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Warehouses>
 */
class WarehousesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'warehouse_name' => fake()->company() . ' Warehouse',
            'warehouse_code' => fake()->unique()->bothify('WH-####'),
            'warehouse_type' => fake()->randomElement(['Main', 'Distribution', 'Regional', 'Fulfillment']),
            'location_address' => fake()->address(),
            'manager_id' => \App\Models\UsersRoles\User::factory(),
            'capacity_units' => fake()->numberBetween(1000, 100000),
            'status' => fake()->randomElement(['Active', 'Inactive', 'Under Maintenance']),
        ];
    }
}
