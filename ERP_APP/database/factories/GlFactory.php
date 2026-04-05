<?php

namespace Database\Factories;

use App\Models\Accounting\Gl;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Gl>
 */
class GlFactory extends Factory
{
    protected $model = Gl::class;

    public function definition(): array
    {
        $debit = fake()->randomFloat(2, 0, 10000);
        $credit = fake()->randomFloat(2, 0, 10000);

        return [
            'account_code' => fake()->unique()->bothify('GL-####'),
            'account_name' => fake()->randomElement(['Cash', 'Accounts Receivable', 'Revenue', 'Expense', 'Inventory']),
            'account_type' => fake()->randomElement(['Asset', 'Liability', 'Equity', 'Revenue', 'Expense']),
            'debit' => $debit,
            'credit' => $credit,
            'balance' => round($credit - $debit, 2),
            'description' => fake()->optional()->sentence(),
            'transaction_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'reference_number' => fake()->optional()->bothify('REF-#####'),
            'status' => fake()->randomElement(['active', 'inactive']),
            'parent_account_id' => null,
        ];
    }
}
