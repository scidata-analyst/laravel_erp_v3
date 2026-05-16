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
            'payroll_period' => $this->faker->monthName() . ' ' . $this->faker->year(),
            'basic_salary' => $this->faker->randomFloat(2, 15000, 100000),
            'allowances' => $this->faker->randomFloat(2, 1000, 10000),
            'deductions' => $this->faker->randomFloat(2, 500, 5000),
            'net_pay' => $this->faker->randomFloat(2, 10000, 80000),
            'status' => $this->faker->randomElement(['Pending', 'Processed', 'Paid']),
        ];
    }
}
