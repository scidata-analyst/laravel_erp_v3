<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_sync', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->constrained('online_channels')->onDelete('cascade');
            $table->dateTime('last_sync_time')->nullable();
            $table->integer('total_synced_items')->default(0);
            $table->integer('sync_errors')->default(0);
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_sync');
    }
};