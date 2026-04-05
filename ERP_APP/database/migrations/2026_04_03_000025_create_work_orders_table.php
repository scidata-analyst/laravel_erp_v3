<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('wo_number')->unique();
            $table->foreignId('product_bom_id')->nullable()->constrained('boms')->onDelete('set null');
            $table->integer('qty_to_produce')->default(0);
            $table->string('priority')->default('normal');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('employees')->onDelete('set null');
            $table->string('status')->default('pending');
            $table->integer('actual_qty_produced')->default(0);
            $table->integer('scrap_quantity')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};