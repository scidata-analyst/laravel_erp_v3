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
            $table->string('product_batch_work_order')->nullable();
            $table->foreignId('inspector_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('inspection_type')->nullable();
            $table->date('inspection_date')->nullable();
            $table->integer('sample_size')->nullable();
            $table->text('checklist_items_notes')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qc_checklists');
    }
};