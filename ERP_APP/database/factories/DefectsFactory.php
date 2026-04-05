<?php

namespace Database\Factories;

use App\Models\HR\Employees;
use App\Models\Inventory\ProductCatalog;
use App\Models\QualityControl\Compliance;
use App\Models\QualityControl\Defects;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Defects>
 */
class DefectsFactory extends Factory
{
    protected $model = Defects::class;

    public function definition(): array
    {
        return [
            'defect_number' => 'DEF-' . Str::upper(fake()->unique()->bothify('######')),
            'product_id' => ProductCatalog::query()->inRandomOrder()->value('id'),
            'batch_number' => fake()->optional()->bothify('BT-#####'),
            'defect_type' => fake()->randomElement(['Surface Scratch', 'Dimensional Error', 'Packaging Issue', 'Color Mismatch']),
            'severity' => fake()->randomElement(['low', 'medium', 'high', 'critical']),
            'description' => fake()->paragraph(),
            'detected_by' => Employees::query()->inRandomOrder()->value('id'),
            'detection_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'status' => fake()->randomElement(['open', 'in_progress', 'resolved', 'closed']),
            'resolution' => fake()->optional()->sentence(),
            'resolution_date' => fake()->optional()->dateTimeBetween('-1 month', 'now'),
            'cost_impact' => fake()->randomFloat(2, 0, 5000),
            'affected_quantity' => fake()->numberBetween(0, 100),
            'compliance_id' => fake()->boolean(50) ? Compliance::query()->inRandomOrder()->value('id') : null,
        ];
    }
}
