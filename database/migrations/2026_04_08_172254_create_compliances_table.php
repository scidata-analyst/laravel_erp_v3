<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compliance', function (Blueprint $table) {
            $table->id();
            $table->string('standard_regulation')->nullable();
            $table->text('scope')->nullable();
            $table->date('audit_date')->nullable();
            $table->date('next_audit_date')->nullable();
            $table->string('auditor')->nullable();
            $table->text('findings_notes')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compliance');
    }
};