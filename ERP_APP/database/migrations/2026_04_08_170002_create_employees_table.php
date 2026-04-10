<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('employee_id')->unique();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->decimal('basic_salary', 10, 2)->nullable();
            $table->date('join_date')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};