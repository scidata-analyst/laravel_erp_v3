<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forecastings', function (Blueprint $table) {
            $table->id();
            $table->string('forecast_name');
            $table->string('forecast_type')->nullable();
            $table->string('period_type')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('base_data_source')->nullable();
            $table->decimal('growth_rate', 5, 2)->nullable();
            $table->decimal('seasonal_factor', 5, 2)->nullable();
            $table->decimal('confidence_level', 5, 2)->nullable();
            $table->json('forecast_data')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forecastings');
    }
};