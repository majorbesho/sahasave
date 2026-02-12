<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_transactions', function (Blueprint $table) {
            $table->id();

            // المفاتيح الخارجية
            $table->foreignId('referral_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // معلومات المعاملة
            $table->enum('transaction_type', [
                'signup_bonus',
                'appointment_bonus',
                'cashback',
                'points_earning',
                'points_redemption',
                'referral_bonus',
                'tier_upgrade'
            ]);

            // المبالغ والنقاط
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('currency', 3)->default('USD');
            $table->integer('points_earned')->default(0);
            $table->integer('points_used')->default(0);

            // الحالة والتواريخ
            $table->enum('status', ['pending', 'completed', 'failed', 'cancelled'])->default('pending');
            $table->timestamp('transaction_date')->useCurrent();
            $table->timestamp('processed_at')->nullable();

            // المعلومات المرجعية
            $table->foreignId('appointment_id')->nullable()->constrained()->onDelete('set null');
            $table->unsignedBigInteger('reward_id')->nullable();

            // بيانات إضافية
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable();

            // معلومات التحقق
            $table->string('transaction_ref')->unique()->nullable();
            $table->string('external_ref')->nullable();

            $table->timestamps();

            // الفهارس
            $table->index(['user_id', 'transaction_type']);
            $table->index(['referral_id', 'status']);
            $table->index('transaction_date');
            $table->index('transaction_ref');
            $table->index(['status', 'processed_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_transactions');
    }
}
