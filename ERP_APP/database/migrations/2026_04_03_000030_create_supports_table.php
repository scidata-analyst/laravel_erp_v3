<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->foreignId('lead_id')->nullable()->constrained('leads')->onDelete('set null');
            $table->string('subject');
            $table->text('description')->nullable();
            $table->string('priority')->default('medium');
            $table->string('category')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->string('status')->default('open');
            $table->text('resolution')->nullable();
            $table->datetime('resolution_date')->nullable();
            $table->integer('customer_satisfaction')->nullable();
            $table->decimal('response_time_hours', 6, 2)->nullable();
            $table->datetime('created_date')->nullable();
            $table->datetime('last_response_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};