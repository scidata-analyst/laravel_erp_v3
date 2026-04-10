<?php

namespace Database\Seeders\QualityControl;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\QualityControl\Defects::factory(20)->create();
    }
}
