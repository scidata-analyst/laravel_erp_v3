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
            'report_name' => $this->faker->words(2, true) . ' Report',
            'module' => $this->faker->randomElement(['Sales', 'Purchase', 'Inventory', 'HR', 'Finance']),
            'selected_fields' => json_encode(['field1', 'field2', 'field3']),
            'filter_by' => $this->faker->optional()->sentence(),
            'schedule' => $this->faker->randomElement(['Daily', 'Weekly', 'Monthly', 'On Demand']),
            'output_format' => $this->faker->randomElement(['PDF', 'Excel', 'CSV']),
        ];
    }
}
