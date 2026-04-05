<?php

namespace Database\Factories;

use App\Models\Ecommerce\Pos;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Pos>
 */
class PosFactory extends Factory
{
    protected $model = Pos::class;

    public function definition(): array
    {
        return [
            'terminal_name' => 'Terminal ' . fake()->unique()->numberBetween(1, 99),
            'location' => fake()->city(),
            'store_code' => 'STORE-' . Str::upper(fake()->bothify('###')),
            'device_id' => 'DEV-' . Str::upper(fake()->unique()->bothify('######')),
            'cash_drawer_balance' => fake()->randomFloat(2, 0, 3000),
            'session_status' => fake()->randomElement(['open', 'closed']),
            'current_user_id' => User::query()->inRandomOrder()->value('id'),
            'last_sync_date' => fake()->optional()->dateTimeBetween('-3 days', 'now'),
            'offline_mode' => fake()->boolean(20),
            'configuration' => [
                'printer' => fake()->boolean(),
                'barcode_scanner' => fake()->boolean(),
            ],
            'status' => fake()->randomElement(['active', 'inactive', 'maintenance']),
        ];
    }
}
