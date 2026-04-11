<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forecasting', function (Blueprint $table) {
            $table->id();
            $table->string('forecast_name')->nullable();
            $table->string('forecast_type')->nullable();
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->string('model')->nullable();
            $table->decimal('accuracy_percentage', 5, 2)->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forecasting');
    }
};