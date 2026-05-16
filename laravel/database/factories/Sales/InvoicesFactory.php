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
            'invoice_number' => $this->faker->unique()->numerify('INV-#####'),
            'sales_order_ref' => $this->faker->optional()->numerify('SO-#####'),
            'invoice_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'due_date' => $this->faker->dateTimeBetween('now', '+2 months'),
            'amount' => $this->faker->randomFloat(2, 100, 10000),
            'tax_percentage' => $this->faker->randomFloat(2, 0, 20),
            'notes' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['Draft', 'Sent', 'Paid', 'Overdue', 'Cancelled']),
        ];
    }
}
