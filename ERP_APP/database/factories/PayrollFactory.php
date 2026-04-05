<?php

namespace Database\Factories;

use App\Models\HR\Employees;
use App\Models\HR\Payroll;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payroll>
 */
class PayrollFactory extends Factory
{
    protected $model = Payroll::class;

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-6 months', '-1 month');
        $end = (clone $start)->modify('+29 days');
        $basic = fake()->randomFloat(2, 20000, 120000);
        $bonus = fake()->randomFloat(2, 0, 15000);
        $overtimeHours = fake()->randomFloat(2, 0, 25);
        $overtimeRate = fake()->randomFloat(2, 150, 500);
        $deductions = [
            'tax' => fake()->randomFloat(2, 1000, 8000),
            'provident_fund' => fake()->randomFloat(2, 500, 4000),
        ];
        $netPay = $basic + ($overtimeHours * $overtimeRate) + $bonus - array_sum($deductions);

        return [
            'employee_id' => Employees::query()->inRandomOrder()->value('id'),
            'pay_period' => $start->format('Y-m-d') . '|' . $end->format('Y-m-d'),
            'basic_salary' => $basic,
            'overtime_hours' => $overtimeHours,
            'overtime_rate' => $overtimeRate,
            'bonus' => $bonus,
            'deductions' => $deductions,
            'net_pay' => max(0, $netPay),
            'pay_date' => $end->format('Y-m-d'),
            'payment_method' => fake()->randomElement(['Bank Transfer', 'Cash', 'Check']),
            'status' => fake()->randomElement(['pending', 'paid', 'draft']),
        ];
    }
}
