<?php

namespace Database\Factories;

use App\Models\Inventory\ProductCatalog;
use App\Models\Sales\Customers;
use App\Models\Sales\SalesOrders;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<SalesOrders>
 */
class SalesOrdersFactory extends Factory
{
    protected $model = SalesOrders::class;

    public function definition(): array
    {
        $items = ProductCatalog::query()->inRandomOrder()->limit(fake()->numberBetween(1, 4))->get();
        $orderItems = $items->map(function ($product) {
            $quantity = fake()->numberBetween(1, 8);
            $unitPrice = (float) ($product->unit_price ?? fake()->randomFloat(2, 20, 200));

            return [
                'product_id' => $product->id,
                'product_name' => $product->product_name,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'line_total' => round($quantity * $unitPrice, 2),
            ];
        })->values()->all();

        $discount = fake()->randomFloat(2, 0, 200);
        $gross = collect($orderItems)->sum('line_total');

        return [
            'so_number' => 'SO-' . Str::upper(fake()->unique()->bothify('######')),
            'customer_id' => Customers::query()->inRandomOrder()->value('id'),
            'order_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'delivery_date' => fake()->dateTimeBetween('now', '+1 month'),
            'payment_terms' => fake()->randomElement(['Cash', 'Net 15', 'Net 30']),
            'discount' => $discount,
            'total_amount' => max(0, $gross - $discount),
            'status' => fake()->randomElement(['draft', 'confirmed', 'shipped', 'delivered']),
            'order_items' => $orderItems,
            'notes' => fake()->sentence(),
        ];
    }
}
