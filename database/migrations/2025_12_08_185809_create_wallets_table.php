<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
           $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('wallet_number')->unique();
            $table->enum('type', ['personal', 'medical', 'savings', 'referral'])->default('personal');
            $table->enum('currency', ['SAR', 'USD', 'EUR'])->default('SAR');
            $table->decimal('balance', 15, 2)->default(0);
            $table->decimal('pending_balance', 15, 2)->default(0);
            $table->decimal('hold_balance', 15, 2)->default(0);
            $table->decimal('total_deposits', 15, 2)->default(0);
            $table->decimal('total_withdrawals', 15, 2)->default(0);
            $table->decimal('total_transactions', 15, 2)->default(0);
            $table->enum('status', ['active', 'frozen', 'suspended', 'closed'])->default('active');
            $table->boolean('is_default')->default(false);
            $table->json('settings')->nullable();
            $table->json('limits')->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // فهارس
            $table->index(['user_id', 'type']);
            $table->index(['wallet_number']);
            $table->index(['status', 'type']);
            $table->index(['user_id', 'is_default']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
