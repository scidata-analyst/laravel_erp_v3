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
            'name' => fake()->randomElement(['Sales Revenue', 'Accounts Receivable', 'Inventory', 'Accounts Payable', 'Equipment', 'Salaries']),
            'type' => fake()->randomElement(['Asset', 'Liability', 'Equity', 'Revenue', 'Expense']),
            'code' => fake()->unique()->numerify('GL-####'),
            'debit' => fake()->randomFloat(2, 0, 50000),
            'credit' => fake()->randomFloat(2, 0, 50000),
            'narration' => fake()->optional()->sentence(),
        ];
    }
}
