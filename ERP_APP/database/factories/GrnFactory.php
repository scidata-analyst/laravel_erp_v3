<?php

namespace Database\Factories;

use App\Models\Purchase\Grn;
use App\Models\Purchase\PurchaseOrders;
use App\Models\Purchase\Suppliers;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Grn>
 */
class GrnFactory extends Factory
{
    protected $model = Grn::class;

    public function definition(): array
    {
        return [
            'grn_number' => 'GRN-' . Str::upper(fake()->unique()->bothify('######')),
            'purchase_order_id' => PurchaseOrders::query()->inRandomOrder()->value('id'),
            'supplier_id' => Suppliers::query()->inRandomOrder()->value('id'),
            'received_date' => fake()->dateTimeBetween('-2 months', 'now'),
            'total_items' => fake()->numberBetween(1, 8),
            'total_quantity' => fake()->numberBetween(10, 250),
            'status' => fake()->randomElement(['pending', 'partial', 'completed']),
            'notes' => fake()->optional()->sentence(),
            'received_by' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
