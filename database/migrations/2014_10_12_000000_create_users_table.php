<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');

            // الحالة والدور
            $table->enum('status', ['active', 'inactive', 'pending', 'rejected', 'suspended'])->default('pending');
            $table->enum('role', ['admin', 'patient', 'doctor', 'clinic_admin', 'medical_center_admin'])->default('patient');

            // التحقق
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();

            // المعلومات الشخصيةا
            $table->string('photo')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('nationality')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_phone')->nullable();

            // نظام الإحالة
            $table->string('referral_code')->unique()->nullable();
            $table->foreignId('referred_by')->nullable()->constrained('users');
            $table->integer('referral_count')->default(0);
            $table->decimal('total_referral_earnings', 10, 2)->default(0);
            $table->integer('total_bonus_points')->default(0);
            $table->integer('available_bonus_points')->default(0);
            $table->decimal('lifetime_savings', 10, 2)->default(0);
            $table->decimal('total_cashback_earned', 10, 2)->default(0);
            $table->string('referral_tier')->default('bronze');
            $table->timestamp('last_referral_at')->nullable();

            // بيانات إضافية
            $table->json('meta')->nullable();
            $table->string('timezone')->default('UTC');
            $table->string('language', 10)->default('ar');

            // تسجيل الدخول الاجتماعي
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();

            // إشعارات
            $table->string('onesignal_device_id')->nullable();
            $table->boolean('push_notifications')->default(true);
            $table->boolean('email_notifications')->default(true);
            $table->boolean('sms_notifications')->default(true);

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            // فهارس
            $table->index(['role', 'status']);
            $table->index('referral_code');
            $table->index('referred_by');
            $table->index('referral_tier');
            $table->index('last_referral_at');
            $table->index(['status', 'created_at']);





            $table->decimal('lifetime_spent', 15, 2)->default(0)->after('lifetime_savings');
            $table->integer('total_appointments')->default(0)->after('referral_count');
            $table->integer('completed_appointments')->default(0)->after('total_appointments');
            $table->integer('cancelled_appointments')->default(0)->after('completed_appointments');
            $table->decimal('average_rating', 3, 2)->nullable()->after('total_cashback_earned');
            $table->integer('total_reviews')->default(0)->after('average_rating');
            $table->date('member_since')->nullable()->after('total_reviews');
            $table->json('achievements')->nullable()->after('member_since');

            // فهارس إضافية
            $table->index(['loyalty_tier', 'available_bonus_points']);
            $table->index(['total_appointments', 'completed_appointments']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
