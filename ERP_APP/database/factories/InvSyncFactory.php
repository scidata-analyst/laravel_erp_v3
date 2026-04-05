<?php

namespace Database\Factories;

use App\Models\Ecommerce\InvSync;
use App\Models\Ecommerce\OnlineChannels;
use App\Models\Ecommerce\Pos;
use App\Models\Inventory\ProductCatalog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<InvSync>
 */
class InvSyncFactory extends Factory
{
    protected $model = InvSync::class;

    public function definition(): array
    {
        $product = ProductCatalog::query()->inRandomOrder()->first();
        $online = fake()->randomFloat(2, 0, 500);
        $local = fake()->randomFloat(2, 0, 500);

        return [
            'sync_reference' => 'SYNC-' . Str::upper(fake()->unique()->bothify('######')),
            'terminal_id' => Pos::query()->inRandomOrder()->value('id'),
            'channel_id' => OnlineChannels::query()->inRandomOrder()->value('id'),
            'sync_type' => fake()->randomElement(['full', 'partial', 'manual']),
            'product_sku' => $product?->sku,
            'online_quantity' => $online,
            'local_quantity' => $local,
            'variance' => round($online - $local, 2),
            'sync_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'status' => fake()->randomElement(['pending', 'in_progress', 'success', 'failed']),
            'error_message' => fake()->optional()->sentence(),
            'retry_count' => fake()->numberBetween(0, 3),
        ];
    }
}
