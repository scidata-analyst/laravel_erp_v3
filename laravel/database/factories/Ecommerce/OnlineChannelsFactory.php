<?php

namespace Database\Factories\Ecommerce;

use App\Models\Ecommerce\OnlineChannels;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OnlineChannels>
 */
class OnlineChannelsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'channel_name' => fake()->company() . ' Store',
            'platform' => fake()->randomElement(['Shopify', 'WooCommerce', 'Amazon', 'eBay', 'Magento']),
            'api_store_url' => fake()->optional()->url(),
            'api_key' => fake()->optional()->sha256(),
            'sync_frequency' => fake()->randomElement(['Hourly', 'Daily', 'Weekly']),
            'status' => fake()->randomElement(['Active', 'Inactive', 'Syncing']),
        ];
    }
}
