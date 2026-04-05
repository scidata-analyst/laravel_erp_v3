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
            $table->string('platform');
            $table->string('api_endpoint')->nullable();
            $table->string('api_key')->nullable();
            $table->string('webhook_url')->nullable();
            $table->string('sync_frequency')->nullable();
            $table->datetime('last_sync_date')->nullable();
            $table->string('status')->default('active');
            $table->string('default_currency')->default('USD');
            $table->boolean('tax_inclusive')->default(false);
            $table->json('shipping_methods')->nullable();
            $table->json('payment_methods')->nullable();
            $table->json('configuration')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_channels');
    }
};