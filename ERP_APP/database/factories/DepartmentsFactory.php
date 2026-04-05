<?php

namespace Database\Factories;

use App\Models\HR\Departments;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Departments>
 */
class DepartmentsFactory extends Factory
{
    protected $model = Departments::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Sales',
                'Purchase',
                'Inventory',
                'Accounting',
                'Human Resources',
                'Operations',
                'Customer Support',
                'Production',
            ]),
            'description' => fake()->sentence(),
            'manager_id' => null,
            'status' => fake()->randomElement(['active', 'active', 'inactive']),
        ];
    }
}
