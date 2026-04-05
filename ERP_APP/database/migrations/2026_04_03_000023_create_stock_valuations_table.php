<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_valuations', function (Blueprint $table) {
            $table->id();
            $table->date('valuation_date')->nullable();
            $table->foreignId('product_id')->nullable()->constrained('product_catalogs')->onDelete('cascade');
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->onDelete('set null');
            $table->decimal('quantity_on_hand', 12, 2)->nullable();
            $table->decimal('unit_cost', 10, 2)->nullable();
            $table->decimal('total_value', 12, 2)->nullable();
            $table->string('valuation_method')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_valuations');
    }
};