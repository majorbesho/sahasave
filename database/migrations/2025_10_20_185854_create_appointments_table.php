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

            // العلاقات
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('medical_center_id')->nullable()->constrained()->onDelete('set null');
            // $table->foreignId('reward_id')->nullable()->constrained()->onDelete('set null');
            // $table->foreignId('referral_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('cancelled_by')->nullable()->constrained('users')->onDelete('set null');

            // المعلومات الأساسية
            $table->string('appointment_number')->unique();
            $table->enum('type', ['video_call', 'audio_call', 'direct_visit']);
            $table->enum('mode', ['online', 'offline'])->default('online');
            $table->string('service_type')->default('general_visit');
            $table->timestamp('scheduled_for');
            $table->timestamp('scheduled_until')->nullable();
            $table->integer('duration')->default(30); // بالدقائق

            // الحالة
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');

            // الرسوم والمكافآت
            $table->decimal('original_fee', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('final_fee', 10, 2)->default(0);
            $table->json('applied_rewards')->nullable();
            $table->decimal('discounted_fee', 10, 2)->default(0);
            $table->decimal('applied_discount', 10, 2)->default(0);
            $table->decimal('cashback_earned', 10, 2)->default(0);

            // الملاحظات
            $table->text('patient_notes')->nullable();
            $table->text('doctor_notes')->nullable();
            $table->text('symptoms')->nullable();
            $table->text('reason')->nullable();

            // الإلغاء
            $table->text('cancellation_reason')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            // التقييم
            $table->tinyInteger('rating')->nullable();
            $table->text('review')->nullable();
            $table->timestamp('reviewed_at')->nullable();

            // التأمين
            $table->boolean('insurance_covered')->default(false);
            $table->json('insurance_details')->nullable();

            // المتابعة
            $table->boolean('follow_up_required')->default(false);
            $table->text('follow_up_notes')->nullable();

            // التذكيرات
            $table->boolean('reminder_sent')->default(false);

            // التواريخ المهمة
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            // إعادة الجدولة
            $table->foreignId('rescheduled_from')->nullable()->constrained('appointments')->onDelete('set null');

            // روابط المكالمات
            $table->string('video_call_url')->nullable();
            $table->string('audio_call_url')->nullable();

            // تفاصيل الموقع
            $table->json('location_details')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->enum('appointment_type', ['video', 'audio', 'chat', 'in-person'])->default('in-person');
            $table->string('visit_type')->default('General'); // string for flexibility

            // الفهارس
            $table->index(['doctor_id', 'status']);
            $table->index(['patient_id', 'status']);
            $table->index('scheduled_for');
            $table->index('appointment_number');
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
