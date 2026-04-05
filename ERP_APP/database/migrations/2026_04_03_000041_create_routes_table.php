<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('route_name');
            $table->foreignId('driver_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->string('vehicle_number')->nullable();
            $table->string('start_location')->nullable();
            $table->string('end_location')->nullable();
            $table->decimal('route_distance', 10, 2)->nullable();
            $table->decimal('estimated_duration', 6, 2)->nullable();
            $table->decimal('actual_duration', 6, 2)->nullable();
            $table->decimal('fuel_consumed', 8, 2)->nullable();
            $table->integer('delivery_count')->default(0);
            $table->string('status')->default('pending');
            $table->date('route_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
