<?php

namespace Database\Factories;

use App\Models\HR\Employees;
use App\Models\QualityControl\Compliance;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Compliance>
 */
class ComplianceFactory extends Factory
{
    protected $model = Compliance::class;

    public function definition(): array
    {
        $auditDate = fake()->dateTimeBetween('-4 months', 'now');
        $dueDate = (clone $auditDate)->modify('+30 days');

        return [
            'report_number' => 'CMP-' . Str::upper(fake()->unique()->bothify('######')),
            'compliance_type' => fake()->randomElement(['ISO', 'Safety', 'Environmental', 'Quality']),
            'standard_reference' => fake()->randomElement(['ISO 9001:2015', 'ISO 14001:2015', 'OSHA', 'GMP']),
            'audit_date' => $auditDate,
            'auditor_id' => Employees::query()->inRandomOrder()->value('id'),
            'findings' => [fake()->sentence(), fake()->sentence()],
            'risk_level' => fake()->randomElement(['low', 'medium', 'high']),
            'corrective_actions' => [fake()->sentence(), fake()->sentence()],
            'due_date' => $dueDate,
            'completion_date' => fake()->boolean(40) ? (clone $dueDate)->modify('-' . fake()->numberBetween(1, 10) . ' days') : null,
            'status' => fake()->randomElement(['pending', 'in_progress', 'completed']),
            'notes' => fake()->optional()->paragraph(),
            'attachments' => [fake()->slug() . '.pdf'],
        ];
    }
}
