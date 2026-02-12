<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('reward_programs');
        Schema::enableForeignKeyConstraints();
        Schema::create('reward_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->enum('type', ['referral', 'loyalty', 'seasonal', 'promotional', 'achievement']);
            $table->enum('target_audience', ['all', 'patients', 'doctors', 'new_users', 'existing_users']);
            $table->text('description')->nullable();
            $table->json('rules')->nullable();
            $table->json('reward_structure')->nullable();
            $table->integer('points_reward')->default(0);
            $table->decimal('cash_reward', 10, 2)->default(0);
            $table->integer('bonus_percentage')->nullable();
            $table->integer('max_rewards_per_user')->nullable();
            $table->integer('total_budget')->nullable();
            $table->integer('used_budget')->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_active')->default(true);
            $table->boolean('requires_approval')->default(false);
            $table->integer('priority')->default(0);
            $table->json('eligibility_criteria')->nullable();
            $table->json('notification_settings')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // فهارس
            $table->index(['code', 'is_active']);
            $table->index(['type', 'start_date', 'end_date']);
            $table->index(['is_active', 'end_date']);
            $table->index(['target_audience', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reward_programs');
    }
}
