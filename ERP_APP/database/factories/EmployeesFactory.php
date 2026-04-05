<?php

namespace Database\Factories;

use App\Models\HR\Departments;
use App\Models\HR\Employees;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Employees>
 */
class EmployeesFactory extends Factory
{
    protected $model = Employees::class;

    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'employee_code' => 'EMP-' . Str::upper(fake()->unique()->bothify('####')),
            'position' => fake()->jobTitle(),
            'department' => Departments::query()->inRandomOrder()->value('name') ?? fake()->randomElement(['Sales', 'Inventory', 'Accounts']),
            'basic_salary' => fake()->randomFloat(2, 25000, 140000),
            'join_date' => fake()->dateTimeBetween('-6 years', '-1 month'),
            'contract_type' => fake()->randomElement(['Permanent', 'Contract', 'Intern']),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'status' => fake()->randomElement(['active', 'active', 'inactive']),
            'manager_id' => null,
        ];
    }
}
