<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->json('widget_config')->nullable();
            $table->json('layout_preferences')->nullable();
            $table->string('theme')->default('light');
            $table->string('language')->default('en');
            $table->string('timezone')->default('UTC');
            $table->string('default_date_range')->nullable();
            $table->integer('refresh_interval')->default(300);
            $table->boolean('is_default')->default(false);
            $table->string('dashboard_type')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dashboards');
    }
};