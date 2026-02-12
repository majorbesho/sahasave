<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();



            // المستخدمون المعنيون
            $table->foreignId('referrer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('referred_id')->constrained('users')->onDelete('cascade');

            // البرنامج والإعدادات
            $table->unsignedBigInteger('reward_program_id')->nullable();
            $table->string('referral_code_used');
            $table->enum('referral_type', ['patient', 'doctor', 'both'])->default('patient');

            // الحالة والتواريخ
            $table->enum('status', ['pending', 'active', 'completed', 'expired', 'cancelled'])->default('pending');
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            // المكافآت
            $table->decimal('bonus_amount', 10, 2)->default(0);
            $table->string('bonus_currency', 3)->default('USD');
            $table->enum('bonus_type', ['fixed', 'percentage', 'points'])->default('fixed');
            $table->integer('max_bonus_uses')->default(1);

            // التقدم والشروط
            $table->json('conditions_met')->nullable();
            $table->json('completed_steps')->nullable();

            // بيانات إضافية
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // فهارس فريدة
            $table->unique(['referrer_id', 'referred_id']);
            $table->index(['status', 'expires_at']);
            $table->index('referral_code_used');
            $table->index(['reward_program_id', 'status']);
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referrals');
    }
}
