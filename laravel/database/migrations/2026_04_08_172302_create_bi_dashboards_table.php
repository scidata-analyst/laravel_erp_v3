<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bi_dashboards', function (Blueprint $table) {
            $table->id();
            $table->string('widget_name')->nullable();
            $table->string('chart_type')->nullable();
            $table->string('data_source_module')->nullable();
            $table->string('refresh_rate')->nullable();
            $table->string('dashboard_name')->nullable();
            $table->foreignId('created_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bi_dashboards');
    }
};