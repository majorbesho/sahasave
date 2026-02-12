<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rewards', function (Blueprint $table) {
            // Add missing columns
            $table->string('code')->unique()->after('id');
            $table->text('description')->nullable()->after('title');
            $table->string('type')->default('cashback')->after('description');
            $table->string('currency')->nullable()->after('amount');
            $table->string('source_type')->nullable()->after('status');
            $table->unsignedBigInteger('source_id')->nullable()->after('source_type');
            $table->timestamp('issued_at')->nullable()->after('source_id');
            $table->timestamp('used_at')->nullable()->after('issued_at');
            $table->foreignId('referral_id')->nullable()->constrained('users')->onDelete('set null')->after('used_at');
            $table->unsignedBigInteger('reward_program_id')->nullable()->after('referral_id');
            $table->string('discount_type')->nullable()->after('reward_program_id');
            $table->decimal('discount_value', 10, 2)->nullable()->after('discount_type');
            $table->decimal('min_consultation_value', 10, 2)->nullable()->after('discount_value');
            $table->decimal('max_discount_amount', 10, 2)->nullable()->after('min_consultation_value');
            $table->decimal('cashback_amount', 10, 2)->nullable()->after('max_discount_amount');
            $table->string('cashback_currency')->nullable()->after('cashback_amount');
            $table->integer('bonus_points')->nullable()->after('cashback_currency');
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->onDelete('set null')->after('bonus_points');
            $table->json('conditions')->nullable()->after('appointment_id');
            $table->integer('usage_limit')->nullable()->after('conditions');
            $table->integer('used_count')->default(0)->after('usage_limit');
            $table->json('metadata')->nullable()->after('used_count');
            $table->json('applicable_to')->nullable()->after('metadata');
            $table->json('excluded_doctors')->nullable()->after('applicable_to');
            $table->json('excluded_specialties')->nullable()->after('excluded_doctors');
            $table->boolean('is_stackable')->default(false)->after('excluded_specialties');
            $table->integer('priority')->default(1)->after('is_stackable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rewards', function (Blueprint $table) {
            $table->dropColumn([
                'code',
                'description',
                'type',
                'currency',
                'source_type',
                'source_id',
                'issued_at',
                'used_at',
                'referral_id',
                'reward_program_id',
                'discount_type',
                'discount_value',
                'min_consultation_value',
                'max_discount_amount',
                'cashback_amount',
                'cashback_currency',
                'bonus_points',
                'appointment_id',
                'conditions',
                'usage_limit',
                'used_count',
                'metadata',
                'applicable_to',
                'excluded_doctors',
                'excluded_specialties',
                'is_stackable',
                'priority'
            ]);
        });
    }
};
