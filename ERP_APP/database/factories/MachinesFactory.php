<?php

namespace Database\Factories;

use App\Models\Logistics\Warehouses;
use App\Models\Production\Machines;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Machines>
 */
class MachinesFactory extends Factory
{
    protected $model = Machines::class;

    public function definition(): array
    {
        return [
            'machine_name' => fake()->words(2, true),
            'machine_code' => fake()->unique()->bothify('MC-###'),
            'machine_type' => fake()->randomElement(['CNC', 'Packing', 'Assembly', 'Printing']),
            'manufacturer' => fake()->company(),
            'model' => strtoupper(fake()->bothify('MDL-###')),
            'warehouse_id' => Warehouses::query()->inRandomOrder()->value('id'),
            'status' => fake()->randomElement(['active', 'maintenance', 'out_of_order']),
        ];
    }
}
