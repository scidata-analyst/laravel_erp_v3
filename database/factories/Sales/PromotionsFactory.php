<?php

namespace Database\Factories\Sales;

use App\Models\Sales\Promotions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Promotions>
 */
class PromotionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'promo_code' => fake()->unique()->bothify('PROMO-????####'),
            'description' => fake()->sentence(),
            'discount_value' => fake()->randomFloat(2, 5, 50),
            'discount_type' => fake()->randomElement(['Percentage', 'Fixed']),
            'minimum_order_amount' => fake()->randomFloat(2, 0, 1000),
            'valid_from' => fake()->dateTimeBetween('-1 month', 'now'),
            'valid_to' => fake()->dateTimeBetween('now', '+3 months'),
            'applicable_products' => fake()->optional()->words(3, true),
            'status' => fake()->randomElement(['Active', 'Inactive', 'Scheduled', 'Expired']),
        ];
    }
}
