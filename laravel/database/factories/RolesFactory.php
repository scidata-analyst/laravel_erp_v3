<?php

namespace Database\Factories;

use App\Models\UsersRoles\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;

class RolesFactory extends Factory
{
    protected $model = Roles::class;

    public function definition(): array
    {
        return [
            'role_name' => fake()->unique()->word().'_role',
            'description' => fake()->sentence(),
            'status' => 'active',
        ];
    }
}
