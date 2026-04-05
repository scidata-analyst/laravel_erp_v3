<?php

namespace Database\Factories;

use App\Models\Sales\Discounts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Discounts>
 */
class DiscountsFactory extends Factory
{
    protected $model = Discounts::class;

    public function definition(): array
    {
        $type = fake()->randomElement(['percentage', 'fixed']);
        $start = fake()->dateTimeBetween('-2 months', '+1 month');
        $usageLimit = fake()->numberBetween(20, 200);

        return [
            'discount_name' => fake()->words(2, true) . ' Discount',
            'discount_type' => $type,
            'discount_value' => $type === 'percentage'
                ? fake()->randomFloat(2, 5, 30)
                : fake()->randomFloat(2, 50, 1000),
            'applicable_to' => fake()->randomElement(['All Products', 'Category', 'Customer Segment']),
            'start_date' => $start,
            'end_date' => fake()->dateTimeBetween($start, '+3 months'),
            'usage_limit' => $usageLimit,
            'used_count' => fake()->numberBetween(0, $usageLimit),
            'status' => fake()->randomElement(['active', 'inactive']),
            'description' => fake()->sentence(),
            'created_by' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
