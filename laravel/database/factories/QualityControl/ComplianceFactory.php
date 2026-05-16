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
            'standard_regulation' => $this->faker->randomElement(['ISO 9001', 'ISO 14001', 'ISO 45001', 'GMP', 'CE']),
            'scope' => $this->faker->sentence(),
            'audit_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'next_audit_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'auditor' => $this->faker->name(),
            'findings_notes' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['Compliant', 'Non-Compliant', 'Pending', 'Under Review']),
        ];
    }
}
