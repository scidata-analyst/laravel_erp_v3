<?php

namespace Database\Factories;

use App\Models\Reports\CustomReports;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CustomReports>
 */
class CustomReportsFactory extends Factory
{
    protected $model = CustomReports::class;

    public function definition(): array
    {
        return [
            'report_name' => fake()->words(3, true),
            'report_type' => fake()->randomElement(['sales', 'inventory', 'financial', 'hr']),
            'description' => fake()->sentence(),
            'query_sql' => 'SELECT * FROM ' . fake()->randomElement(['sales_orders', 'customers', 'stock_movements', 'employees']),
            'parameters' => ['from' => fake()->date(), 'to' => fake()->date()],
            'schedule' => fake()->optional()->randomElement(['0 8 * * *', '0 9 * * 1', '0 6 1 * *']),
            'recipients' => [fake()->safeEmail(), fake()->safeEmail()],
            'format_type' => fake()->randomElement(['pdf', 'excel', 'csv']),
            'created_by' => User::query()->inRandomOrder()->value('id'),
            'last_run_date' => fake()->optional()->dateTimeBetween('-2 months', 'now'),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
