<?php

namespace Database\Factories;

use App\Models\Accounting\ApAr;
use App\Models\Purchase\Suppliers;
use App\Models\Sales\Customers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ApAr>
 */
class ApArFactory extends Factory
{
    protected $model = ApAr::class;

    public function definition(): array
    {
        $type = fake()->randomElement(['AP', 'AR']);
        $amount = fake()->randomFloat(2, 500, 50000);
        $paid = fake()->randomFloat(2, 0, $amount);
        $party = $type === 'AR'
            ? Customers::query()->inRandomOrder()->value('company_name')
            : Suppliers::query()->inRandomOrder()->value('company_name');

        return [
            'ref_number' => 'APAR-' . Str::upper(fake()->unique()->bothify('######')),
            'party_name' => $party,
            'type' => $type,
            'due_date' => fake()->dateTimeBetween('now', '+2 months'),
            'amount' => $amount,
            'paid' => $paid,
            'balance' => round($amount - $paid, 2),
            'status' => fake()->randomElement(['pending', 'partial', 'paid']),
            'reference' => fake()->optional()->bothify('REF-#####'),
            'description' => fake()->sentence(),
        ];
    }
}
