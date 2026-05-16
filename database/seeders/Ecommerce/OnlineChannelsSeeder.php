<?php

namespace Database\Seeders\Ecommerce;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OnlineChannelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Ecommerce\OnlineChannels::factory(10)->create();
    }
}
