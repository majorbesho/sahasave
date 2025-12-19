<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinationsTable extends Migration
{
    public function up()
    {
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('vaccine_name')->nullable();
            $table->string('vaccine_code')->nullable()->comment('WHO vaccine code');

            $table->date('vaccination_date');
            $table->string('dose_number')->nullable()->comment('1st, 2nd, 3rd, Booster');
            $table->string('lot_number')->nullable();
            $table->string('manufacturer')->nullable();

            $table->foreignId('administered_by')->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('Doctor/Nurse');

            $table->string('site')->nullable()->comment('موقع الحقن');
            $table->string('route')->nullable()->comment('IM, SC, Oral');

            $table->date('next_dose_date')->nullable();
            $table->boolean('completed_series')->default(false);

            $table->text('side_effects')->nullable();
            $table->text('notes')->nullable();

            $table->string('certificate_number')->nullable();
            $table->string('certificate_file')->nullable();

            $table->timestamps();

            $table->index(['patient_id', 'vaccination_date']);
            $table->index('vaccine_name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vaccinations');
    }
}
