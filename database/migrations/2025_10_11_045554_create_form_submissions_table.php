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
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained()->onDelete('cascade');
            $table->string('submission_id')->unique(); // For tracking submissions
            $table->json('data'); // Store all form field data as JSON
            $table->string('submitted_by')->nullable(); // Vendor email or identifier
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('notes')->nullable(); // Admin notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_submissions');
    }
};
