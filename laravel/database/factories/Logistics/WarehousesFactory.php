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
            'warehouse_name' => $this->faker->company() . ' Warehouse',
            'warehouse_code' => $this->faker->unique()->bothify('WH-####'),
            'warehouse_type' => $this->faker->randomElement(['Main', 'Distribution', 'Regional', 'Fulfillment']),
            'location_address' => $this->faker->address(),
            'manager_id' => \App\Models\UsersRoles\User::factory(),
            'capacity_units' => $this->faker->numberBetween(1000, 100000),
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Under Maintenance']),
        ];
    }
}
