<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRewardProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reward_programs', function (Blueprint $table) {
            $table->id();

            // المفاتيح الخارجية
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('reward_program_id')->constrained()->onDelete('cascade');

            // معلومات الانضمام
            $table->timestamp('joined_at')->useCurrent();
            $table->enum('status', ['active', 'completed', 'cancelled', 'expired'])->default('active');

            // التقدم والإنجاز
            $table->integer('completed_referrals')->default(0);
            $table->decimal('earned_bonus', 10, 2)->default(0);
            $table->decimal('progress_percentage', 5, 2)->default(0);
            $table->integer('remaining_days')->nullable();

            // تواريخ المتابعة
            $table->timestamp('last_referral_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            // بيانات إضافية
            $table->json('achieved_milestones')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            // فهارس فريدة
            $table->unique(['user_id', 'reward_program_id']);
            $table->index(['user_id', 'status']);
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
        Schema::dropIfExists('user_reward_programs');
    }
}
