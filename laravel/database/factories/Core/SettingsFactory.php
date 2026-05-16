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
            'company_name' => $this->faker->company(),
            'company_email' => $this->faker->companyEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'country' => $this->faker->country(),
            'session_timeout_minutes' => $this->faker->numberBetween(15, 120),
            'two_factor_auth_enabled' => $this->faker->boolean(),
            'password_policy' => 'Minimum 8 characters, uppercase, lowercase, number, special char',
            'ip_whitelist' => $this->faker->optional()->ipv4(),
            'email_notifications_enabled' => $this->faker->boolean(),
            'low_stock_threshold' => $this->faker->numberBetween(10, 100),
            'alert_recipients' => $this->faker->companyEmail(),
            'default_valuation_method' => $this->faker->randomElement(['FIFO', 'LIFO', 'Weighted Average']),
            'auto_reorder_enabled' => $this->faker->boolean(),
            'default_warehouse_id' => \App\Models\Logistics\Warehouses::factory(),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
