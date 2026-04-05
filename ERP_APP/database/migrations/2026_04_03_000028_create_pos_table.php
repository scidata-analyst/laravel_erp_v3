<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pos', function (Blueprint $table) {
            $table->id();
            $table->string('terminal_name');
            $table->string('location')->nullable();
            $table->string('store_code')->nullable();
            $table->string('device_id')->nullable();
            $table->decimal('cash_drawer_balance', 10, 2)->default(0);
            $table->string('session_status')->default('closed');
            $table->foreignId('current_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->datetime('last_sync_date')->nullable();
            $table->boolean('offline_mode')->default(false);
            $table->json('configuration')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pos');
    }
};