<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UsersRoles\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Roles>
 */
class RolesFactory extends Factory
{
    protected $model = Roles::class;

    public function definition(): array
    {
        $permissions = Roles::getAvailablePermissions();
        shuffle($permissions);

        return [
            'role_name' => fake()->unique()->jobTitle(),
            'description' => fake()->sentence(),
            'permissions' => array_slice($permissions, 0, fake()->numberBetween(3, 8)),
            'is_system_role' => false,
            'is_active' => true,
            'created_by' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
