<?php

namespace Database\Factories;

use App\Models\Ecommerce\OnlineChannels;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OnlineChannels>
 */
class OnlineChannelsFactory extends Factory
{
    protected $model = OnlineChannels::class;

    public function definition(): array
    {
        $platform = fake()->randomElement(['shopify', 'woocommerce', 'magento', 'daraz']);

        return [
            'channel_name' => ucfirst($platform) . ' ' . fake()->company(),
            'platform' => $platform,
            'api_endpoint' => fake()->url(),
            'api_key' => fake()->sha256(),
            'webhook_url' => fake()->url(),
            'sync_frequency' => fake()->randomElement(['15min', 'hourly', 'daily']),
            'last_sync_date' => fake()->optional()->dateTimeBetween('-7 days', 'now'),
            'status' => fake()->randomElement(['active', 'inactive']),
            'default_currency' => fake()->randomElement(['USD', 'BDT', 'EUR']),
            'tax_inclusive' => fake()->boolean(),
            'shipping_methods' => fake()->randomElements(['Courier', 'Pickup', 'Express'], fake()->numberBetween(1, 3)),
            'payment_methods' => fake()->randomElements(['Cash', 'Card', 'Mobile Banking'], fake()->numberBetween(1, 3)),
            'configuration' => [
                'region' => fake()->countryCode(),
                'sandbox' => fake()->boolean(),
            ],
        ];
    }
}
