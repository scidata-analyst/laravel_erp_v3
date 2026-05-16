<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('promo_code')->unique();
            $table->text('description')->nullable();
            $table->decimal('discount_value', 10, 2);
            $table->string('discount_type');
            $table->decimal('minimum_order_amount', 10, 2)->nullable();
            $table->dateTime('valid_from');
            $table->dateTime('valid_to');
            $table->string('applicable_products')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};