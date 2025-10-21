<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();

            // المفاتيح الخارجية
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('referral_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('reward_program_id')->nullable()->constrained()->onDelete('set null');

            // المعلومات الأساسية
            $table->enum('type', ['discount', 'cashback', 'points', 'free_consultation']);
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('code')->unique()->nullable();

            // إعدادات الخصم
            $table->enum('discount_type', ['percentage', 'fixed'])->nullable();
            $table->decimal('discount_value', 10, 2)->nullable();
            $table->decimal('min_consultation_value', 10, 2)->nullable();
            $table->decimal('max_discount_amount', 10, 2)->nullable();

            // إعدادات الكاش باك
            $table->decimal('cashback_amount', 10, 2)->nullable();
            $table->string('cashback_currency', 3)->default('USD');

            // النقاط
            $table->integer('bonus_points')->default(0);

            // الحالة والتواريخ
            $table->enum('status', ['active', 'used', 'expired', 'cancelled'])->default('active');
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('used_at')->nullable();

            // الاستخدام
            $table->integer('usage_limit')->nullable();
            $table->integer('used_count')->default(0);

            // المرجع
            $table->foreignId('appointment_id')->nullable()->constrained()->onDelete('set null');

            // الشروط والإعدادات
            $table->json('conditions')->nullable();

            $table->timestamps();

            // الفهارس
            $table->index(['user_id', 'status']);
            $table->index(['type', 'status']);
            $table->index('code');
            $table->index('expires_at');
            $table->index(['status', 'expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewards');
    }
}
