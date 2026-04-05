<?php

namespace Database\Factories;

use App\Models\HR\Employees;
use App\Models\Logistics\Warehouses;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Warehouses>
 */
class WarehousesFactory extends Factory
{
    protected $model = Warehouses::class;

    public function definition(): array
    {
        $capacity = fake()->numberBetween(1000, 10000);
        $used = fake()->numberBetween(0, (int) ($capacity * 0.85));

        return [
            'warehouse_name' => fake()->city() . ' Warehouse',
            'code' => 'WH-' . Str::upper(fake()->unique()->bothify('###')),
            'type' => fake()->randomElement(['Distribution', 'Retail', 'Cold Storage', 'Returns']),
            'location_address' => fake()->address(),
            'manager_id' => Employees::query()->inRandomOrder()->value('id'),
            'capacity_units' => $capacity,
            'used_units' => $used,
            'status' => fake()->randomElement(['active', 'maintenance', 'inactive']),
            'contact_phone' => fake()->phoneNumber(),
            'email' => fake()->companyEmail(),
        ];
    }
}
