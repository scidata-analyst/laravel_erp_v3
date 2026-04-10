<?php

namespace Database\Seeders\Reports;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiDashboardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Reports\BiDashboards::factory(15)->create();
    }
}
