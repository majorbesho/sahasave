<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users');
            $table->foreignId('doctor_id')->constrained('users');
            $table->foreignId('medical_center_id')->constrained('medical_centers');

            // معلومات الموعد
            $table->string('appointment_number')->unique()->comment('رقم الموعد الفريد');
            $table->enum('type', ['consultation', 'follow_up', 'checkup', 'emergency'])->default('consultation');
            $table->enum('mode', ['in_person', 'virtual', 'phone'])->default('in_person');

            // التوقيت
            $table->dateTime('scheduled_for');
            $table->dateTime('scheduled_until');
            $table->integer('duration')->default(30)->comment('المدة بالدقائق');

            // الحالة
            $table->enum('status', ['scheduled', 'confirmed', 'completed', 'cancelled', 'no_show'])->default('scheduled');

            // المعلومات المالية
            $table->decimal('original_fee', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('final_fee', 10, 2)->default(0);
            $table->json('applied_rewards')->nullable()->comment('المكافآت المستخدمة');

            // معلومات إضافية
            $table->text('patient_notes')->nullable()->comment('ملاحظات المريض');
            $table->text('doctor_notes')->nullable()->comment('ملاحظات الطبيب');
            $table->text('cancellation_reason')->nullable()->comment('سبب الإلغاء');

            // التقييم
            $table->integer('rating')->nullable()->comment('التقييم من 1-5');
            $table->text('review')->nullable()->comment('التعليق');
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();

            $table->index(['doctor_id', 'scheduled_for']);
            $table->index(['patient_id', 'status']);
            $table->index(['medical_center_id', 'scheduled_for']);
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
        Schema::dropIfExists('appointments');
    }
}
