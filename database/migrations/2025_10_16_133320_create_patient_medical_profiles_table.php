<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientMedicalProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_medical_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users');

            // المعلومات الطبية الأساسية
            $table->decimal('height', 5, 2)->nullable()->comment('الطول بالسم');
            $table->decimal('weight', 5, 2)->nullable()->comment('الوزن بالكجم');
            $table->decimal('bmi', 5, 2)->nullable()->comment('مؤشر كتلة الجسم');
            $table->string('blood_type', 10)->nullable()->comment('فصيلة الدم');

            // التاريخ الطبي
            $table->json('allergies')->nullable()->comment('الحساسيات');
            $table->json('chronic_diseases')->nullable()->comment('الأمراض المزمنة');
            $table->json('current_medications')->nullable()->comment('الأدوية الحالية');
            $table->json('surgeries')->nullable()->comment('العمليات الجراحية السابقة');
            $table->json('family_history')->nullable()->comment('التاريخ العائلي المرضي');

            // العادات
            $table->enum('smoking', ['never', 'former', 'current'])->default('never');
            $table->enum('alcohol', ['never', 'occasional', 'regular'])->default('never');
            $table->enum('activity_level', ['sedentary', 'light', 'moderate', 'active', 'very_active'])->default('sedentary');

            // معلومات إضافية
            $table->text('medical_notes')->nullable();
            $table->text('special_needs')->nullable();

            $table->timestamps();

            $table->unique('patient_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_medical_profiles');
    }
}
