<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('machine_labors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_order_id')->constrained('work_orders')->onDelete('cascade');
            $table->foreignId('machine_id')->nullable()->constrained('machines')->onDelete('set null');
            $table->foreignId('operator_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->datetime('start_time')->nullable();
            $table->datetime('end_time')->nullable();
            $table->integer('output_quantity')->default(0);
            $table->integer('scrap_quantity')->default(0);
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('machine_labors');
    }
};
