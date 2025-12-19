<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyPointsTable extends Migration
{
    public function up()
    {
        Schema::create('loyalty_points', function (Blueprint $table) {
           $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('points')->default(0);
            $table->integer('available_points')->default(0);
            $table->integer('pending_points')->default(0);
            $table->integer('expired_points')->default(0);
            $table->integer('redeemed_points')->default(0);
            $table->integer('total_earned')->default(0);
            $table->integer('total_redeemed')->default(0);
            $table->string('loyalty_tier')->default('bronze');
            $table->decimal('points_value_rate', 8, 4)->default(0.01);
            $table->date('tier_expires_at')->nullable();
            $table->date('next_evaluation_date')->nullable();
            $table->json('tier_benefits')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // فهارس
            $table->index(['user_id', 'loyalty_tier']);
            $table->index(['loyalty_tier', 'points']);
            $table->index(['tier_expires_at']);
            $table->index(['next_evaluation_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('loyalty_points');
    }
}
