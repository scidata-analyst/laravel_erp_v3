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
            'channel_name' => $this->faker->company() . ' Store',
            'platform' => $this->faker->randomElement(['Shopify', 'WooCommerce', 'Amazon', 'eBay', 'Magento']),
            'api_store_url' => $this->faker->optional()->url(),
            'api_key' => $this->faker->optional()->sha256(),
            'sync_frequency' => $this->faker->randomElement(['Hourly', 'Daily', 'Weekly']),
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Syncing']),
        ];
    }
}
