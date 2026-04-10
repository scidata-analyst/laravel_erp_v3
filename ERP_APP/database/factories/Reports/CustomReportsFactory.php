<?php

namespace Database\Factories\Reports;

use App\Models\Reports\CustomReports;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CustomReports>
 */
class CustomReportsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'report_name' => fake()->words(2, true) . ' Report',
            'module' => fake()->randomElement(['Sales', 'Purchase', 'Inventory', 'HR', 'Finance']),
            'selected_fields' => json_encode(['field1', 'field2', 'field3']),
            'filter_by' => fake()->optional()->sentence(),
            'schedule' => fake()->randomElement(['Daily', 'Weekly', 'Monthly', 'On Demand']),
            'output_format' => fake()->randomElement(['PDF', 'Excel', 'CSV']),
        ];
    }
}
