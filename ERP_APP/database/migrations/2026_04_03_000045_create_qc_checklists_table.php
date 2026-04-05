<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qc_checklists', function (Blueprint $table) {
            $table->id();
            $table->string('checklist_number')->unique();
            $table->foreignId('work_order_id')->nullable()->constrained('work_orders')->onDelete('set null');
            $table->foreignId('inspector_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->string('inspection_type')->nullable();
            $table->date('inspection_date')->nullable();
            $table->integer('sample_size')->default(0);
            $table->integer('items_checked')->default(0);
            $table->integer('items_passed')->default(0);
            $table->decimal('pass_rate', 5, 2)->nullable();
            $table->string('status')->default('pending');
            $table->json('checklist_items')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qc_checklists');
    }
};
