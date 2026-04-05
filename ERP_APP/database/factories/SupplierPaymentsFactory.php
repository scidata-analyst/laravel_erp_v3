<?php

namespace Database\Factories;

use App\Models\Purchase\PurchaseOrders;
use App\Models\Purchase\SupplierPayments;
use App\Models\Purchase\Suppliers;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<SupplierPayments>
 */
class SupplierPaymentsFactory extends Factory
{
    protected $model = SupplierPayments::class;

    public function definition(): array
    {
        return [
            'payment_number' => 'SP-' . Str::upper(fake()->unique()->bothify('######')),
            'supplier_id' => Suppliers::query()->inRandomOrder()->value('id'),
            'purchase_order_id' => PurchaseOrders::query()->inRandomOrder()->value('id'),
            'payment_date' => fake()->dateTimeBetween('-2 months', 'now'),
            'amount' => fake()->randomFloat(2, 500, 50000),
            'payment_method' => fake()->randomElement(['bank_transfer', 'cash', 'check']),
            'reference_number' => fake()->optional()->bothify('REF-#####'),
            'status' => fake()->randomElement(['pending', 'approved', 'paid']),
            'notes' => fake()->optional()->sentence(),
            'approved_by' => fake()->boolean(60) ? User::query()->inRandomOrder()->value('id') : null,
        ];
    }
}
