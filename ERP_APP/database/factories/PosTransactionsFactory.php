<?php

namespace Database\Factories;

use App\Models\Ecommerce\Pos;
use App\Models\Ecommerce\PosTransactions;
use App\Models\Inventory\ProductCatalog;
use App\Models\Sales\Customers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<PosTransactions>
 */
class PosTransactionsFactory extends Factory
{
    protected $model = PosTransactions::class;

    public function definition(): array
    {
        $product = ProductCatalog::query()->inRandomOrder()->first();
        $quantity = fake()->numberBetween(1, 4);
        $amount = round(($product?->unit_price ?? fake()->randomFloat(2, 20, 200)) * $quantity, 2);
        $tax = round($amount * fake()->randomFloat(2, 0.03, 0.12), 2);
        $total = round($amount + $tax, 2);
        $paymentMethod = fake()->randomElement(['cash', 'card', 'mobile']);
        $cashTendered = $paymentMethod === 'cash' ? round($total + fake()->randomFloat(2, 0, 50), 2) : null;

        return [
            'transaction_number' => 'POSTRX-' . Str::upper(fake()->unique()->bothify('######')),
            'terminal_id' => Pos::query()->inRandomOrder()->value('id'),
            'transaction_type' => fake()->randomElement(['sale', 'return', 'refund']),
            'payment_method' => $paymentMethod,
            'amount' => $amount,
            'tax_amount' => $tax,
            'total_amount' => $total,
            'customer_id' => Customers::query()->inRandomOrder()->value('id'),
            'order_reference' => null,
            'items' => [[
                'product_id' => $product?->id,
                'product_name' => $product?->product_name,
                'quantity' => $quantity,
                'unit_price' => $product?->unit_price,
            ]],
            'cash_tendered' => $cashTendered,
            'change_given' => $cashTendered ? round($cashTendered - $total, 2) : 0,
            'transaction_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'status' => fake()->randomElement(['completed', 'pending', 'cancelled']),
        ];
    }
}
