<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('boms', function (Blueprint $table) {
            $table->id();
            $table->string('bom_number')->unique();
            $table->string('finished_product')->nullable();
            $table->string('version')->nullable();
            $table->integer('lead_time_days')->nullable();
            $table->decimal('estimated_cost', 12, 2)->nullable();
            $table->string('status')->default('draft');
            $table->json('components')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boms');
    }
};