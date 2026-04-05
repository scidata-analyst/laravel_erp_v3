<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pos_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->unique();
            $table->foreignId('terminal_id')->nullable()->constrained('pos')->onDelete('set null');
            $table->string('transaction_type')->default('sale');
            $table->string('payment_method')->nullable();
            $table->decimal('amount', 12, 2)->default(0);
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->foreignId('order_reference')->nullable()->constrained('sales_orders')->onDelete('set null');
            $table->json('items')->nullable();
            $table->decimal('cash_tendered', 12, 2)->nullable();
            $table->decimal('change_given', 12, 2)->nullable();
            $table->datetime('transaction_date')->nullable();
            $table->string('status')->default('completed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pos_transactions');
    }
};
