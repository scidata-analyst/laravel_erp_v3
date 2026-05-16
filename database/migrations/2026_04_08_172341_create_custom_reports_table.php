<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_name')->nullable();
            $table->string('module')->nullable();
            $table->json('selected_fields')->nullable();
            $table->text('filter_by')->nullable();
            $table->string('schedule')->nullable();
            $table->string('output_format')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_reports');
    }
};