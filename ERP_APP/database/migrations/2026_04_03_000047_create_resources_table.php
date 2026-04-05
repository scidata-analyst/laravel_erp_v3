<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained('tasks')->onDelete('cascade');
            $table->string('resource_name')->nullable();
            $table->string('resource_type')->nullable();
            $table->integer('allocation_percentage')->default(100);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('cost_per_hour', 8, 2)->nullable();
            $table->decimal('total_cost', 12, 2)->default(0);
            $table->decimal('utilization_rate', 5, 2)->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
