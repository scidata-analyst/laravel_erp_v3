<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('pay_period')->nullable();
            $table->decimal('basic_salary', 10, 2)->nullable();
            $table->decimal('overtime_hours', 6, 2)->default(0);
            $table->decimal('overtime_rate', 8, 2)->default(0);
            $table->decimal('bonus', 10, 2)->default(0);
            $table->json('deductions')->nullable();
            $table->decimal('net_pay', 10, 2)->nullable();
            $table->date('pay_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};