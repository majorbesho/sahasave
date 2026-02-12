<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalty_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('string'); // string, integer, boolean, json
            $table->string('group')->default('general');
            $table->string('display_name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('loyalty_settings')->insert([
            [
                'key' => 'wallet_welcome_bonus',
                'value' => '50',
                'type' => 'integer',
                'group' => 'wallet',
                'display_name' => 'Wallet Welcome Bonus',
                'description' => 'Initial bonus amount credited to new users wallet.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'loyalty_welcome_points',
                'value' => '100',
                'type' => 'integer',
                'group' => 'loyalty',
                'display_name' => 'Loyalty Welcome Points',
                'description' => 'Initial loyalty points granted to new users.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'welcome_voucher_template',
                'value' => 'WELCOME100',
                'type' => 'string',
                'group' => 'loyalty',
                'display_name' => 'Welcome Voucher Code',
                'description' => 'The coupon code template to be shared with new users.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'points_value_rate',
                'value' => '0.01',
                'type' => 'decimal',
                'group' => 'loyalty',
                'display_name' => 'Points Value Rate',
                'description' => 'The monetary value of a single loyalty point.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loyalty_settings');
    }
}
