<?php

namespace Database\Factories\QualityControl;

use App\Models\QualityControl\Defects;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Defects>
 */
class DefectsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => \App\Models\Inventory\ProductCatalog::factory(),
            'batch_lot_number' => fake()->bothify('BATCH-####'),
            'defect_type' => fake()->randomElement(['Manufacturing', 'Material', 'Design', 'Packaging', 'Other']),
            'severity' => fake()->randomElement(['Critical', 'Major', 'Minor']),
            'quantity_affected' => fake()->numberBetween(1, 100),
            'description_root_cause' => fake()->sentence(),
            'status' => fake()->randomElement(['Open', 'Investigating', 'Resolved', 'Closed']),
        ];
    }
}
