<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointRedemptionsTable extends Migration
{
    public function up()
    {
        Schema::create('point_redemptions', function (Blueprint $table) {
           $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('voucher_id')->nullable()->constrained()->nullOnDelete();
            $table->string('redemption_code')->unique();
            $table->integer('points_used');
            $table->decimal('monetary_value', 10, 2);
            $table->string('reward_type');
            $table->json('reward_details')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed', 'expired'])->default('pending');
            $table->enum('redemption_channel', ['web', 'mobile', 'pos', 'api']);
            $table->text('notes')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            // فهارس
            $table->index(['user_id', 'created_at']);
            $table->index(['redemption_code']);
            $table->index(['status', 'expires_at']);
            $table->index(['voucher_id', 'status']);
            $table->index(['redemption_channel', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('point_redemptions');
    }
}
