<?php

namespace Database\Factories\HR;

use App\Models\HR\Employees;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employees>
 */
class EmployeesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'employee_id' => fake()->unique()->numerify('EMP-#####'),
            'designation' => fake()->randomElement(['Manager', 'Senior Developer', 'Developer', 'Designer', 'Analyst', 'Coordinator']),
            'department' => fake()->randomElement(['IT', 'HR', 'Finance', 'Marketing', 'Operations', 'Sales']),
            'basic_salary' => fake()->randomFloat(2, 15000, 150000),
            'join_date' => fake()->dateTimeBetween('-5 years', 'now'),
            'contract_type' => fake()->randomElement(['Full-time', 'Part-time', 'Contract', 'Intern']),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'status' => fake()->randomElement(['Active', 'On Leave', 'Terminated']),
        ];
    }
}
