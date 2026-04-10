<?php

namespace Database\Factories\Core;

use App\Models\Core\Settings;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Settings>
 */
class SettingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => fake()->company(),
            'company_email' => fake()->companyEmail(),
            'phone_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'country' => fake()->country(),
            'session_timeout_minutes' => fake()->numberBetween(15, 120),
            'two_factor_auth_enabled' => fake()->boolean(),
            'password_policy' => 'Minimum 8 characters, uppercase, lowercase, number, special char',
            'ip_whitelist' => fake()->optional()->ipv4(),
            'email_notifications_enabled' => fake()->boolean(),
            'low_stock_threshold' => fake()->numberBetween(10, 100),
            'alert_recipients' => fake()->companyEmail(),
            'default_valuation_method' => fake()->randomElement(['FIFO', 'LIFO', 'Weighted Average']),
            'auto_reorder_enabled' => fake()->boolean(),
            'default_warehouse_id' => \App\Models\Logistics\Warehouses::factory(),
            'status' => fake()->randomElement(['Active', 'Inactive']),
        ];
    }
}
