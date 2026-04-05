<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('tax_name');
            $table->decimal('tax_rate', 5, 2);
            $table->string('tax_type');
            $table->string('applicable_to')->nullable();
            $table->text('description')->nullable();
            $table->date('effective_date')->nullable();
            $table->string('status')->default('active');
            $table->string('tax_code')->nullable();
            $table->string('jurisdiction')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};