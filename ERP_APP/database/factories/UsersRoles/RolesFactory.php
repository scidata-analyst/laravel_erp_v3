<?php

namespace Database\Factories\UsersRoles;

use App\Models\UsersRoles\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Roles>
 */
class RolesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role_name' => fake()->unique()->randomElement(['Admin', 'Manager', 'Sales', 'HR', 'Accountant', 'Warehouse Staff']),
            'description' => fake()->sentence(),
            'status' => fake()->randomElement(['Active', 'Inactive']),
        ];
    }
}
