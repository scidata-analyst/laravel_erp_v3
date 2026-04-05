<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ap_ars', function (Blueprint $table) {
            $table->id();
            $table->string('ref_number')->unique();
            $table->string('party_name')->nullable();
            $table->string('type')->nullable();
            $table->date('due_date')->nullable();
            $table->decimal('amount', 12, 2)->nullable();
            $table->decimal('paid', 12, 2)->default(0);
            $table->decimal('balance', 12, 2)->nullable();
            $table->string('status')->default('pending');
            $table->string('reference')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ap_ars');
    }
};