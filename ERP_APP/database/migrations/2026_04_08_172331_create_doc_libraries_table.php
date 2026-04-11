<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('document_library', function (Blueprint $table) {
            $table->id();
            $table->string('document_name');
            $table->string('document_type')->nullable();
            $table->string('related_to')->nullable();
            $table->string('version')->nullable();
            $table->string('access_level')->nullable();
            $table->string('file_path')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('uploaded_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_libraries');
    }
};
