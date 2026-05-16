<?php

namespace Database\Factories\QualityControl;

use App\Models\QualityControl\Compliance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Compliance>
 */
class ComplianceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'standard_regulation' => fake()->randomElement(['ISO 9001', 'ISO 14001', 'ISO 45001', 'GMP', 'CE']),
            'scope' => fake()->sentence(),
            'audit_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'next_audit_date' => fake()->dateTimeBetween('now', '+1 year'),
            'auditor' => fake()->name(),
            'findings_notes' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(['Compliant', 'Non-Compliant', 'Pending', 'Under Review']),
        ];
    }
}
