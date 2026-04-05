<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compliances', function (Blueprint $table) {
            $table->id();
            $table->string('report_number')->unique();
            $table->string('compliance_type')->nullable();
            $table->string('standard_reference')->nullable();
            $table->date('audit_date')->nullable();
            $table->foreignId('auditor_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->json('findings')->nullable();
            $table->string('risk_level')->default('low');
            $table->json('corrective_actions')->nullable();
            $table->date('due_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->json('attachments')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compliances');
    }
};
