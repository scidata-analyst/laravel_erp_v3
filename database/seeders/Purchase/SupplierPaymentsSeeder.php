<?php

namespace Database\Seeders\Purchase;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierPaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Purchase\SupplierPayments::factory(20)->create();
    }
}
