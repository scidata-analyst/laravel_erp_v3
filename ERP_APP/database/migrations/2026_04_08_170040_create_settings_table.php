<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('country')->nullable();
            $table->integer('session_timeout_minutes')->nullable();
            $table->boolean('two_factor_auth_enabled')->default(false);
            $table->text('password_policy')->nullable();
            $table->string('ip_whitelist')->nullable();
            $table->boolean('email_notifications_enabled')->default(true);
            $table->integer('low_stock_threshold')->nullable();
            $table->string('alert_recipients')->nullable();
            $table->string('default_valuation_method')->nullable();
            $table->boolean('auto_reorder_enabled')->default(false);
            $table->foreignId('default_warehouse_id')->nullable()->constrained('warehouses')->onDelete('set null');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};