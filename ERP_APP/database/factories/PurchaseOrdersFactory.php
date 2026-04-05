<?php

namespace Database\Factories;

use App\Models\Inventory\ProductCatalog;
use App\Models\Logistics\Warehouses;
use App\Models\Purchase\PurchaseOrders;
use App\Models\Purchase\Suppliers;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<PurchaseOrders>
 */
class PurchaseOrdersFactory extends Factory
{
    protected $model = PurchaseOrders::class;

    public function definition(): array
    {
        $items = ProductCatalog::query()->inRandomOrder()->limit(fake()->numberBetween(1, 3))->get();
        $orderItems = $items->map(function ($product) {
            $quantity = fake()->numberBetween(5, 25);
            $unitCost = (float) ($product->cost_price ?? fake()->randomFloat(2, 10, 100));

            return [
                'product_id' => $product->id,
                'product_name' => $product->product_name,
                'quantity' => $quantity,
                'unit_cost' => $unitCost,
                'line_total' => round($quantity * $unitCost, 2),
            ];
        })->values()->all();

        return [
            'po_number' => 'PO-' . Str::upper(fake()->unique()->bothify('######')),
            'supplier_id' => Suppliers::query()->inRandomOrder()->value('id'),
            'order_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'expected_delivery' => fake()->dateTimeBetween('now', '+1 month'),
            'warehouse' => Warehouses::query()->inRandomOrder()->value('code'),
            'payment_terms' => fake()->randomElement(['Advance', 'Net 15', 'Net 30']),
            'total_amount' => collect($orderItems)->sum('line_total'),
            'status' => fake()->randomElement(['pending', 'approved', 'received', 'cancelled']),
            'approved_by' => User::query()->inRandomOrder()->value('id'),
            'order_items' => $orderItems,
            'notes' => fake()->sentence(),
        ];
    }
}
