<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('batch_trackings', function (Blueprint $table) {
            $table->id();
            $table->string('batch_lot_number')->unique();
            $table->string('serial_number')->nullable();
            $table->foreignId('product_id')->nullable()->constrained('product_catalogs')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->date('manufacturing_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('status')->default('available');
            $table->string('warehouse_location')->nullable();
            $table->decimal('cost_per_unit', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batch_trackings');
    }
};