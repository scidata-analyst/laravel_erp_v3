<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('warehouse_name');
            $table->string('code')->unique();
            $table->string('type')->nullable();
            $table->text('location_address')->nullable();
            $table->foreignId('manager_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->integer('capacity_units')->nullable();
            $table->integer('used_units')->default(0);
            $table->string('status')->default('active');
            $table->string('contact_phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};