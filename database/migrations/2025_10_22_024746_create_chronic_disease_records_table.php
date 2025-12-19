<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChronicDiseaseRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chronic_disease_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('disease_name')->nullable();
            $table->string('disease_code')->nullable()->comment('ICD-10 code');

            $table->date('diagnosis_date')->nullable();
            $table->foreignId('diagnosed_by')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('status', ['active', 'controlled', 'in_remission', 'cured'])
                ->default('active');

            $table->enum('severity', ['mild', 'moderate', 'severe'])
                ->default('moderate');

            $table->text('symptoms')->nullable();
            $table->text('treatment_plan')->nullable();
            $table->json('current_medications')->nullable();
            $table->text('lifestyle_modifications')->nullable();

            $table->date('last_checkup')->nullable();
            $table->date('next_checkup')->nullable();

            $table->json('test_results')->nullable()->comment('Latest test results');
            $table->json('complications')->nullable();

            $table->boolean('requires_monitoring')->default(true);
            $table->text('monitoring_instructions')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['patient_id', 'status']);
            $table->index('disease_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chronic_disease_records');
    }
}
