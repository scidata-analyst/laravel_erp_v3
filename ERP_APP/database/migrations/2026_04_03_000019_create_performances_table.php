<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('review_period')->nullable();
            $table->decimal('kpi_score', 5, 2)->nullable();
            $table->decimal('goal_achievement', 5, 2)->nullable();
            $table->string('overall_rating')->nullable();
            $table->foreignId('reviewer_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->longText('reviewer_comments')->nullable();
            $table->date('review_date')->nullable();
            $table->string('status')->default('pending');
            $table->json('improvement_plan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};