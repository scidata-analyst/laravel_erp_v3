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
            'warehouse_name' => $this->faker->company().' Warehouse',
            'warehouse_code' => $this->faker->unique()->bothify('WH-####'),
            'warehouse_type' => $this->faker->randomElement(['main', 'distribution', 'fulfillment']),
            'location_address' => $this->faker->address(),
            'manager_id' => null,
            'capacity_units' => $this->faker->numberBetween(1000, 50000),
            'status' => 'active',
        ];
    }
}
