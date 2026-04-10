<?php

namespace Database\Factories\Sales;

use App\Models\Sales\Invoices;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Invoices>
 */
class InvoicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => \App\Models\Sales\Customers::factory(),
            'invoice_number' => fake()->unique()->numerify('INV-#####'),
            'sales_order_ref' => fake()->optional()->numerify('SO-#####'),
            'invoice_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'due_date' => fake()->dateTimeBetween('now', '+2 months'),
            'amount' => fake()->randomFloat(2, 100, 10000),
            'tax_percentage' => fake()->randomFloat(2, 0, 20),
            'notes' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(['Draft', 'Sent', 'Paid', 'Overdue', 'Cancelled']),
        ];
    }
}
