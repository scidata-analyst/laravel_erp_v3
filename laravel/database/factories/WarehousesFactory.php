<?php

namespace Database\Factories;

use App\Models\Logistics\Warehouses;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehousesFactory extends Factory
{
    protected $model = Warehouses::class;

    public function definition(): array
    {
        return [
            'warehouse_name' => fake()->company().' Warehouse',
            'warehouse_code' => fake()->unique()->bothify('WH-####'),
            'warehouse_type' => fake()->randomElement(['main', 'distribution', 'fulfillment']),
            'location_address' => fake()->address(),
            'manager_id' => null,
            'capacity_units' => fake()->numberBetween(1000, 50000),
            'status' => 'active',
        ];
    }
}
