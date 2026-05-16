<?php

namespace Database\Seeders\Ecommerce;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvSyncSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Ecommerce\InvSync::factory(15)->create();
    }
}
