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
            'full_name' => $this->faker->name(),
            'employee_id' => $this->faker->unique()->numerify('EMP-#####'),
            'designation' => $this->faker->randomElement(['Manager', 'Senior Developer', 'Developer', 'Designer', 'Analyst', 'Coordinator']),
            'department' => $this->faker->randomElement(['IT', 'HR', 'Finance', 'Marketing', 'Operations', 'Sales']),
            'basic_salary' => $this->faker->randomFloat(2, 15000, 150000),
            'join_date' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'contract_type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract', 'Intern']),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'status' => $this->faker->randomElement(['Active', 'On Leave', 'Terminated']),
        ];
    }
}
