<?php

namespace Database\Factories\Documents;

use App\Models\Documents\DocVersions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DocVersions>
 */
class DocVersionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'document_id' => \App\Models\Documents\DocLibrary::factory(),
            'new_version' => 'v' . fake()->numerify('#.#'),
            'change_type' => fake()->randomElement(['Update', 'Revision', 'Amendment', 'New Version']),
            'change_summary' => fake()->sentence(),
            'changed_by_user_id' => \App\Models\UsersRoles\User::factory(),
            'approver_id' => \App\Models\UsersRoles\User::factory(),
            'file_path' => '/documents/versions/' . fake()->uuid() . '.pdf',
        ];
    }
}
