<?php

namespace Database\Seeders\Ecommerce;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Ecommerce\Pos::factory(10)->create();
    }
}
