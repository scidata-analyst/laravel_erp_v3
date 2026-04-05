<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doc_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doc_library_id')->constrained('doc_libraries')->onDelete('cascade');
            $table->string('version_number')->nullable();
            $table->string('file_path')->nullable();
            $table->integer('file_size')->nullable();
            $table->text('changes_description')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('is_current')->default(true);
            $table->string('approval_status')->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->date('approval_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doc_versions');
    }
};