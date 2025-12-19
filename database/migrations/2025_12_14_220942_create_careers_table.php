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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('requirements');
            $table->string('location');
            $table->enum('type', ['full-time', 'part-time', 'remote', 'contract', 'internship']);
            $table->string('department');
            $table->string('salary_range')->nullable();
            $table->string('experience_level');
            $table->string('education_level')->nullable();
            $table->json('skills')->nullable();
            $table->json('benefits')->nullable();
            $table->date('application_deadline');
            $table->boolean('is_active')->default(true);
            $table->foreignId('posted_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
