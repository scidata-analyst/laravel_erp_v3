<?php

namespace Database\Factories;

use App\Models\Documents\DocLibrary;
use App\Models\Documents\DocVersions;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DocVersions>
 */
class DocVersionsFactory extends Factory
{
    protected $model = DocVersions::class;

    public function definition(): array
    {
        return [
            'doc_library_id' => DocLibrary::query()->inRandomOrder()->value('id'),
            'version_number' => fake()->randomElement(['1.0', '1.1', '2.0']),
            'file_path' => 'documents/versions/' . fake()->uuid() . '.pdf',
            'file_size' => fake()->numberBetween(10240, 5242880),
            'changes_description' => fake()->sentence(),
            'created_by' => User::query()->inRandomOrder()->value('id'),
            'is_current' => fake()->boolean(30),
            'approval_status' => fake()->randomElement(['approved', 'pending', 'rejected']),
            'approved_by' => fake()->boolean(60) ? User::query()->inRandomOrder()->value('id') : null,
            'approval_date' => fake()->optional()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
