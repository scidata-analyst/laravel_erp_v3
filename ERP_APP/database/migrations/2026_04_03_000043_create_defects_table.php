<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('defects', function (Blueprint $table) {
            $table->id();
            $table->string('defect_number')->unique();
            $table->foreignId('product_id')->nullable()->constrained('product_catalogs')->onDelete('set null');
            $table->string('batch_number')->nullable();
            $table->string('defect_type')->nullable();
            $table->string('severity')->default('medium');
            $table->text('description')->nullable();
            $table->foreignId('detected_by')->nullable()->constrained('employees')->onDelete('set null');
            $table->date('detection_date')->nullable();
            $table->string('status')->default('open');
            $table->text('resolution')->nullable();
            $table->date('resolution_date')->nullable();
            $table->decimal('cost_impact', 10, 2)->default(0);
            $table->integer('affected_quantity')->default(0);
            $table->foreignId('compliance_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('defects');
    }
};
