<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->cascadeOnDelete();
            $table->string('transaction_id')->unique();
            $table->enum('type', [
                'deposit',
                'withdrawal',
                'transfer',
                'payment',
                'refund',
                'cashback',
                'referral_bonus',
                'reward_points',
                'fee',
                'adjustment'
            ]);
            $table->decimal('amount', 15, 2);
            $table->decimal('balance_before', 15, 2);
            $table->decimal('balance_after', 15, 2);
            $table->string('currency', 3)->default('AED');
            $table->enum('status', ['pending', 'completed', 'failed', 'cancelled', 'reversed'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable();
            $table->enum('direction', ['credit', 'debit']);
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('reconciled_at')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();

            // فهارس
            $table->index(['wallet_id', 'created_at']);
            $table->index(['transaction_id']);
            $table->index(['type', 'status']);
            $table->index(['payment_reference']);
            $table->index(['created_at', 'status']);
            $table->index(['category', 'direction']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallet_transactions');
    }
}
