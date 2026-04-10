<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('online_channels', function (Blueprint $table) {
            $table->id();
            $table->string('channel_name');
            $table->string('platform')->nullable();
            $table->string('api_store_url')->nullable();
            $table->string('api_key')->nullable();
            $table->string('sync_frequency')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_channels');
    }
};