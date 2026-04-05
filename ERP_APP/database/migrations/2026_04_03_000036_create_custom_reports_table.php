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
            $table->string('report_name');
            $table->string('report_type')->nullable();
            $table->text('description')->nullable();
            $table->text('query_sql')->nullable();
            $table->json('parameters')->nullable();
            $table->string('schedule')->nullable();
            $table->json('recipients')->nullable();
            $table->string('format_type')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->datetime('last_run_date')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_reports');
    }
};