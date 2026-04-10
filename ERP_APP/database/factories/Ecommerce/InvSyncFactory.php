<?php

namespace Database\Factories\Ecommerce;

use App\Models\Ecommerce\InvSync;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvSync>
 */
class InvSyncFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'channel_id' => \App\Models\Ecommerce\OnlineChannels::factory(),
            'last_sync_time' => fake()->dateTimeBetween('-1 day', 'now'),
            'total_synced_items' => fake()->numberBetween(10, 1000),
            'sync_errors' => fake()->numberBetween(0, 10),
            'status' => fake()->randomElement(['Success', 'Failed', 'Partial']),
        ];
    }
}
