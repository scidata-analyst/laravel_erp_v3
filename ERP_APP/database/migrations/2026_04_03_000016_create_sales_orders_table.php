<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('so_number')->unique();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->date('order_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('payment_terms')->nullable();
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->nullable();
            $table->string('status')->default('draft');
            $table->json('order_items')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('discount_id')->nullable()->constrained('discounts')->onDelete('set null');
            $table->foreignId('promotion_id')->nullable();
            $table->foreignId('channel_id')->nullable()->constrained('online_channels')->onDelete('set null');
            $table->foreignId('tax_id')->nullable()->constrained('taxes')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
