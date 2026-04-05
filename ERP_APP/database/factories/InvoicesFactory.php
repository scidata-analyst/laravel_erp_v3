<?php

namespace Database\Factories;

use App\Models\Sales\Customers;
use App\Models\Sales\Invoices;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Invoices>
 */
class InvoicesFactory extends Factory
{
    protected $model = Invoices::class;

    public function definition(): array
    {
        $amount = fake()->randomFloat(2, 100, 12000);
        $paid = fake()->randomFloat(2, 0, $amount);
        $tax = round($amount * fake()->randomFloat(2, 0.03, 0.15), 2);

        return [
            'invoice_number' => 'INV-' . Str::upper(fake()->unique()->bothify('######')),
            'customer_id' => Customers::query()->inRandomOrder()->value('id'),
            'invoice_date' => fake()->dateTimeBetween('-2 months', 'now'),
            'due_date' => fake()->dateTimeBetween('now', '+1 month'),
            'amount' => $amount,
            'tax' => $tax,
            'paid_amount' => $paid,
            'balance' => max(0, round($amount + $tax - $paid, 2)),
            'status' => fake()->randomElement(['unpaid', 'partial', 'paid', 'overdue']),
            'notes' => fake()->sentence(),
            'generated_by' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
