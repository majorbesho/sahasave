<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('point_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('loyalty_point_id')->nullable()->constrained()->nullOnDelete();
            $table->string('transaction_code')->unique();
            $table->enum('type', [
                'earn_appointment',
                'earn_review',
                'earn_referral',
                'earn_purchase',
                'earn_birthday',
                'earn_anniversary',
                'bonus_campaign',
                'redeem_voucher',
                'redeem_discount',
                'redeem_cashback',
                'expiration',
                'adjustment',
                'transfer'
            ]);
            $table->integer('points');
            $table->integer('points_before');
            $table->integer('points_after');
            $table->decimal('monetary_value', 10, 2)->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'expired', 'cancelled'])->default('pending');
            $table->enum('direction', ['credit', 'debit']);
            $table->string('source_type')->nullable();
            $table->unsignedBigInteger('source_id')->nullable();
            $table->text('description')->nullable();
            $table->json('metadata')->nullable();
            $table->date('expires_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();

            // فهارس
            $table->index(['user_id', 'created_at']);
            $table->index(['transaction_code']);
            $table->index(['type', 'status']);
            $table->index(['source_type', 'source_id']);
            $table->index(['expires_at', 'status']);
            $table->index(['direction', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('point_transactions');
    }
}
