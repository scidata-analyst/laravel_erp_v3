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
            $table->string('dashboard_name');
            $table->text('description')->nullable();
            $table->json('widgets')->nullable();
            $table->json('layout_config')->nullable();
            $table->json('data_sources')->nullable();
            $table->integer('refresh_interval')->default(300);
            $table->string('access_level')->default('private');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('is_public')->default(false);
            $table->string('category')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bi_dashboards');
    }
};