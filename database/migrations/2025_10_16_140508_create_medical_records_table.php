<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->onDelete('set null');
            $table->foreignId('medical_center_id')->constrained('medical_centers')->onDelete('cascade');

            // نوع السجل ومعلوماته
            $table->enum('record_type', [
                'consultation',
                'follow_up',
                'emergency',
                'surgery',
                'lab_test',
                'imaging',
                'vaccination',
                'checkup'
            ])->default('consultation');
            $table->string('title');
            $table->text('description')->nullable();

            // المعلومات الطبية
            $table->json('symptoms')->nullable()->comment('الأعراض');
            $table->text('diagnosis')->nullable()->comment('التشخيص');
            $table->text('treatment_plan')->nullable()->comment('خطة العلاج');
            $table->json('prescriptions')->nullable()->comment('الوصفات الطبية');

            // العلامات الحيوية والنتائج
            $table->json('vital_signs')->nullable()->comment('العلامات الحيوية');
            $table->json('lab_results')->nullable()->comment('نتائج المختبر');
            $table->json('imaging_results')->nullable()->comment('نتائج التصوير');

            // متابعة
            $table->json('follow_up_instructions')->nullable()->comment('تعليمات المتابعة');
            $table->date('next_visit_date')->nullable()->comment('موعد الزيارة القادمة');

            // حالة السجل
            $table->boolean('is_emergency')->default(false);
            $table->enum('confidentiality_level', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->enum('status', ['draft', 'finalized', 'archived'])->default('draft');

            $table->timestamps();

            $table->index(['patient_id', 'created_at']);
            $table->index(['doctor_id', 'created_at']);
            $table->index(['medical_center_id', 'record_type']);
            $table->index('confidentiality_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_records');
    }
}
