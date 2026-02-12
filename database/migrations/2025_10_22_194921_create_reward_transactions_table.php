<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_transactions', function (Blueprint $table) {
            $table->id();

            // المفاتيح الخارجية
            $table->foreignId('reward_id')->constrained('reward_programs')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('appointment_id')->nullable()->constrained()->onDelete('set null');

            // نوع المعاملة
            $table->enum('transaction_type', [
                'discount_application',
                'cashback_earning',
                'points_redemption',
                'reward_issuance',
                'reward_expiration',
                'reward_cancellation'
            ]);

            // القيم المالية
            $table->decimal('amount', 10, 2)->default(0);
            $table->integer('points')->default(0);
            $table->string('currency', 3)->default('USD');

            // الحالة والتواريخ
            $table->enum('status', ['pending', 'completed', 'failed', 'reversed'])->default('pending');
            $table->timestamp('transaction_date')->useCurrent();
            $table->timestamp('effective_date')->nullable();

            // معلومات الخصم
            $table->decimal('original_amount', 10, 2)->nullable();
            $table->decimal('discounted_amount', 10, 2)->nullable();
            $table->decimal('savings_amount', 10, 2)->nullable();

            // بيانات إضافية
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable();

            // معلومات التتبع
            $table->string('transaction_ref')->unique()->nullable();
            $table->string('reversal_ref')->nullable();

            $table->timestamps();

            // الفهارس
            $table->index(['user_id', 'transaction_type']);
            $table->index(['reward_id', 'status']);
            $table->index('transaction_date');
            $table->index('transaction_ref');
            $table->index(['appointment_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reward_transactions');
    }
}
