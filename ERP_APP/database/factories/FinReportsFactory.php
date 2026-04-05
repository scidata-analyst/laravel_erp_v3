<?php

namespace Database\Factories;

use App\Models\Accounting\FinReports;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FinReports>
 */
class FinReportsFactory extends Factory
{
    protected $model = FinReports::class;

    public function definition(): array
    {
        $revenue = fake()->randomFloat(2, 20000, 200000);
        $expenses = fake()->randomFloat(2, 5000, 150000);
        $assets = fake()->randomFloat(2, 50000, 500000);
        $liabilities = fake()->randomFloat(2, 10000, 250000);

        return [
            'report_name' => fake()->words(3, true),
            'report_type' => fake()->randomElement(['balance_sheet', 'income_statement', 'cash_flow', 'trial_balance', 'profit_loss']),
            'description' => fake()->sentence(),
            'report_data' => [
                'total_revenue' => $revenue,
                'total_expenses' => $expenses,
                'net_income' => round($revenue - $expenses, 2),
                'total_assets' => $assets,
                'total_liabilities' => $liabilities,
                'equity' => round($assets - $liabilities, 2),
            ],
            'start_date' => fake()->dateTimeBetween('-12 months', '-2 months'),
            'end_date' => fake()->dateTimeBetween('-2 months', 'now'),
            'created_by' => User::query()->inRandomOrder()->value('id'),
            'status' => fake()->randomElement(['generated', 'pending']),
        ];
    }
}
