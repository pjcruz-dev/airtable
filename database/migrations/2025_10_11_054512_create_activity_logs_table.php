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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('log_name')->nullable(); // e.g., 'form', 'submission', 'field'
            $table->text('description'); // What happened
            $table->string('subject_type')->nullable(); // Model class (Form, FormField, FormSubmission)
            $table->unsignedBigInteger('subject_id')->nullable(); // Model ID
            $table->string('causer_type')->nullable(); // Who did it (User, System, etc.)
            $table->unsignedBigInteger('causer_id')->nullable(); // User ID
            $table->json('properties')->nullable(); // Additional data
            $table->string('event')->nullable(); // created, updated, deleted, submitted, etc.
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            
            $table->index(['log_name', 'subject_type', 'subject_id']);
            $table->index(['causer_type', 'causer_id']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};