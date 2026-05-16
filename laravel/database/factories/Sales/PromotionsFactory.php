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
            'promo_code' => $this->faker->unique()->bothify('PROMO-????####'),
            'description' => $this->faker->sentence(),
            'discount_value' => $this->faker->randomFloat(2, 5, 50),
            'discount_type' => $this->faker->randomElement(['Percentage', 'Fixed']),
            'minimum_order_amount' => $this->faker->randomFloat(2, 0, 1000),
            'valid_from' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'valid_to' => $this->faker->dateTimeBetween('now', '+3 months'),
            'applicable_products' => $this->faker->optional()->words(3, true),
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Scheduled', 'Expired']),
        ];
    }
}
