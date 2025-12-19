<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorMedicalCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_medical_center', function (Blueprint $table) {
            $table->id();
            // المفاتيح الخارجية
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('medical_center_id')->constrained()->onDelete('cascade');

            // معلومات العمل في هذا المركز
            $table->decimal('follow_up_fee', 10, 2)->nullable()->comment('رسوم المتابعة');

            // الإحصاءات الخاصة بهذا المركز
            $table->integer('appointments_count')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0);

            // الحالة
            $table->boolean('is_active')->default(true);
            $table->boolean('accepts_insurance')->default(false);
            $table->json('accepted_insurances')->nullable();

            $table->timestamps();

            // $table->unique(['doctor_id', 'medical_center_id']);
            $table->index(['medical_center_id', 'is_active']);



            // معلومات التوظيف
            $table->enum('employment_type', [
                'full_time',
                'part_time',
                'contract',
                'visiting',
                'consultant'
            ])->default('full_time');
            // أيام العمل
            $table->json('working_days')->nullable()->comment('أيام العمل في الأسبوع');

            // ساعات العمل
            $table->json('working_hours')->nullable()->comment('ساعات العمل اليومية');

            // رسوم الاستشارة
            $table->decimal('consultation_fee', 10, 2)->default(0);

            // التخصص في هذا المركز
            $table->foreignId('specialty_id')->nullable()->constrained('specialties');

            // الحالة
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');

            // بيانات إضافية
            $table->integer('appointment_duration')->default(30)->comment('مدة الموعد بالدقائق');
            $table->integer('max_daily_appointments')->default(20)->comment('الحد الأقصى للمواعيد اليومية');
            $table->text('notes')->nullable()->comment('ملاحظات إضافية');

            // المراجعة والتحقق
            $table->boolean('is_approved')->default(true);
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');


            // فهرس فريد لمنع التكرار
            //$table->unique(['doctor_id', 'medical_center_id']);

            // فهارس إضافية
            // $table->index(['medical_center_id', 'is_active']);
            $table->index(['user_id', 'is_active']);
            $table->index('employment_type');
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
        Schema::dropIfExists('doctor_medical_center');
    }
}
