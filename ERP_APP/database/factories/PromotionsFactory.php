<?php

namespace Database\Factories;

use App\Models\Inventory\ProductCatalog;
use App\Models\Sales\Discounts;
use App\Models\Sales\Promotions;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Promotions>
 */
class PromotionsFactory extends Factory
{
    protected $model = Promotions::class;

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-1 month', '+1 month');
        $usageLimit = fake()->numberBetween(25, 250);

        return [
            'promotion_name' => fake()->catchPhrase(),
            'discount_id' => Discounts::query()->inRandomOrder()->value('id'),
            'start_date' => $start,
            'end_date' => fake()->dateTimeBetween($start, '+4 months'),
            'applicable_products' => ProductCatalog::query()->inRandomOrder()->limit(fake()->numberBetween(1, 4))->pluck('id')->all(),
            'minimum_purchase' => fake()->randomFloat(2, 0, 5000),
            'usage_limit' => $usageLimit,
            'used_count' => fake()->numberBetween(0, $usageLimit),
            'status' => fake()->randomElement(['active', 'inactive']),
            'description' => fake()->sentence(),
            'created_by' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
