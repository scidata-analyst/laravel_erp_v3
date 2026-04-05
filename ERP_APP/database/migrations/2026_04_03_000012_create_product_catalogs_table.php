<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_catalogs', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('sku')->unique();
            $table->string('category')->nullable();
            $table->decimal('unit_price', 12, 2)->nullable();
            $table->decimal('cost_price', 12, 2)->nullable();
            $table->string('warehouse')->nullable();
            $table->integer('reorder_level')->nullable();
            $table->string('valuation_method')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('active');
            $table->string('barcode')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('dimensions')->nullable();
            $table->foreignId('channel_id')->nullable()->constrained('online_channels')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_catalogs');
    }
};