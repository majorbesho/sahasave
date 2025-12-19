<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->enum('type', ['discount', 'cashback', 'free_service', 'points_multiplier', 'gift']);
            $table->enum('discount_type', ['percentage', 'fixed', 'free_shipping'])->nullable();
            $table->decimal('discount_value', 10, 2)->nullable();
            $table->integer('points_required')->nullable();
            $table->decimal('minimum_purchase', 10, 2)->nullable();
            $table->decimal('maximum_discount', 10, 2)->nullable();
            $table->date('valid_from');
            $table->date('valid_to');
            $table->integer('usage_limit')->nullable();
            $table->integer('used_count')->default(0);
            $table->integer('user_usage_limit')->default(1);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_redeemable')->default(true);
            $table->json('applicable_services')->nullable();
            $table->json('restrictions')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // فهارس
            $table->index(['code', 'is_active']);
            $table->index(['type', 'valid_from', 'valid_to']);
            $table->index(['is_active', 'valid_to']);
            $table->index(['is_redeemable', 'points_required']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
