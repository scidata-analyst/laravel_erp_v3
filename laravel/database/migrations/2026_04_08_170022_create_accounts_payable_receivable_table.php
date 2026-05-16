<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts_payable_receivable', function (Blueprint $table) {
            $table->id();
            $table->string('party_name')->nullable();
            $table->string('ap_ar_type');
            $table->decimal('amount', 15, 2)->default(0);
            $table->date('due_date')->nullable();
            $table->string('reference')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts_payable_receivable');
    }
};