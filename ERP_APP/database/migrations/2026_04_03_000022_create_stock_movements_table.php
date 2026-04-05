<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->string('ref_number')->unique();
            $table->date('date')->nullable();
            $table->foreignId('product_id')->nullable()->constrained('product_catalogs')->onDelete('cascade');
            $table->string('movement_type')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('from_warehouse')->nullable();
            $table->string('to_warehouse')->nullable();
            $table->text('reason_notes')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};