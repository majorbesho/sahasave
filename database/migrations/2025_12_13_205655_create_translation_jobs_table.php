<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translation_jobs', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('source'); // source_type, source_id
            $table->json('target_locales');
            $table->enum('status', ['pending', 'processing', 'completed', 'failed', 'reviewed'])->default('pending');
            $table->string('priority')->default('medium'); // low, medium, high
            $table->json('job_data')->nullable(); // extra configs
            $table->unsignedBigInteger('assigned_to')->nullable(); // translator user id
            $table->timestamps();

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translation_jobs');
    }
}
