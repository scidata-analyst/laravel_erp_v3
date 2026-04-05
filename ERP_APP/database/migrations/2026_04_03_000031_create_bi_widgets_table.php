<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bi_widgets', function (Blueprint $table) {
            $table->id();
            $table->string('widget_name');
            $table->string('widget_type')->nullable();
            $table->foreignId('dashboard_id')->nullable();
            $table->string('data_source')->nullable();
            $table->json('query_config')->nullable();
            $table->string('visualization_type')->nullable();
            $table->integer('position_x')->default(0);
            $table->integer('position_y')->default(0);
            $table->integer('width')->default(4);
            $table->integer('height')->default(3);
            $table->integer('refresh_interval')->nullable();
            $table->json('settings')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bi_widgets');
    }
};
