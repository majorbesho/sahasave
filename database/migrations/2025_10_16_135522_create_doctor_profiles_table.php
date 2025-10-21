<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');

            // المعلومات الأساسية
            $table->string('medical_license_number')->unique();
            $table->foreignId('specialty_id')->constrained('specialties');
            $table->string('specialization');

            // ملف الرخصة
            $table->string('license_document_path');
            $table->timestamp('license_verified_at')->nullable();
            $table->string('license_verified_by')->nullable();

            // التعليم والمؤهلات
            $table->string('medical_school')->nullable();
            $table->integer('graduation_year')->nullable();
            $table->json('qualifications')->nullable();
            $table->json('certifications')->nullable();
            $table->json('subspecialties')->nullable();

            // الخبرة العملية
            $table->integer('years_of_experience')->default(0);
            $table->json('work_experience')->nullable();
            $table->string('current_hospital')->nullable();
            $table->string('current_position')->nullable();

            // الوصف والنهج العلاجي
            $table->text('bio')->nullable();
            $table->text('treatment_approach')->nullable();

            // الإحصائيات والتقييمات
            $table->integer('total_consultations')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->integer('rating_count')->default(0);

            // حالة التحقق
            $table->boolean('is_verified')->default(false);
            $table->enum('verification_status', [
                'pending_review',
                'under_review',
                'verified',
                'rejected',
                'suspended'
            ])->default('pending_review');

            // الإعدادات
            $table->boolean('accepting_new_patients')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->decimal('consultation_fee', 8, 2)->nullable();

            // بيانات المراجعة
            $table->text('verification_notes')->nullable();
            $table->timestamp('verification_reviewed_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users');

            $table->timestamps();
            $table->softDeletes();

            // الفهارس
            $table->index(['is_verified', 'verification_status']);
            $table->index('specialty_id');
            $table->index('medical_license_number');
            $table->index(['accepting_new_patients', 'is_verified']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_profiles');
    }
}
