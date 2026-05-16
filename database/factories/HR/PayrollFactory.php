<?php

namespace Database\Factories\HR;

use App\Models\HR\Payroll;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payroll>
 */
class PayrollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => \App\Models\HR\Employees::factory(),
            'payroll_period' => fake()->monthName() . ' ' . fake()->year(),
            'basic_salary' => fake()->randomFloat(2, 15000, 100000),
            'allowances' => fake()->randomFloat(2, 1000, 10000),
            'deductions' => fake()->randomFloat(2, 500, 5000),
            'net_pay' => fake()->randomFloat(2, 10000, 80000),
            'status' => fake()->randomElement(['Pending', 'Processed', 'Paid']),
        ];
    }
}
