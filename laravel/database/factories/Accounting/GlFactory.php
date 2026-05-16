<?php

namespace Database\Factories\Accounting;

use App\Models\Accounting\Gl;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Gl>
 */
class GlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Sales Revenue', 'Accounts Receivable', 'Inventory', 'Accounts Payable', 'Equipment', 'Salaries']),
            'type' => $this->faker->randomElement(['Asset', 'Liability', 'Equity', 'Revenue', 'Expense']),
            'code' => $this->faker->unique()->numerify('GL-####'),
            'debit' => $this->faker->randomFloat(2, 0, 50000),
            'credit' => $this->faker->randomFloat(2, 0, 50000),
            'narration' => $this->faker->optional()->sentence(),
        ];
    }
}
