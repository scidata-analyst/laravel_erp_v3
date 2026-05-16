<?php

namespace Database\Seeders\QualityControl;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplianceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\QualityControl\Compliance::factory(10)->create();
    }
}
