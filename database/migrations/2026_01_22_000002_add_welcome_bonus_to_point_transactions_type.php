<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddWelcomeBonusToPointTransactionsType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // استخدام DB::statement لأن تعديل الـ enum بشكل مباشر ليس مدعوماً في Blueprint بشكل تلقائي في كل قواعد البيانات
        // ولضمان عدم فقدان البيانات الحالية
        $tableName = 'point_transactions';
        $columnName = 'type';

        // جلب القيم الحالية (اختياري، هنا نعتمد على ما نعرفه من المهاجرة الأصلية)
        DB::statement("ALTER TABLE `{$tableName}` MODIFY COLUMN `{$columnName}` ENUM(
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
            'transfer',
            'welcome_bonus'
        ) NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableName = 'point_transactions';
        $columnName = 'type';

        DB::statement("ALTER TABLE `{$tableName}` MODIFY COLUMN `{$columnName}` ENUM(
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
        ) NOT NULL");
    }
}
