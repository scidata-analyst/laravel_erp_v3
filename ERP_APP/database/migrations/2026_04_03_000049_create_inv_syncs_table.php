<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inv_syncs', function (Blueprint $table) {
            $table->id();
            $table->string('sync_reference')->unique();
            $table->foreignId('terminal_id')->nullable()->constrained('pos')->onDelete('set null');
            $table->foreignId('channel_id')->nullable()->constrained('online_channels')->onDelete('set null');
            $table->string('sync_type')->nullable();
            $table->string('product_sku')->nullable();
            $table->decimal('online_quantity', 10, 2)->nullable();
            $table->decimal('local_quantity', 10, 2)->nullable();
            $table->decimal('variance', 10, 2)->default(0);
            $table->datetime('sync_date')->nullable();
            $table->string('status')->default('pending');
            $table->text('error_message')->nullable();
            $table->integer('retry_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inv_syncs');
    }
};
