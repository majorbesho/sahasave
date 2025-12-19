<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyTiersTable extends Migration
{
    public function up()
    {
        Schema::create('loyalty_tiers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->integer('level')->unique();
            $table->integer('min_points_required')->default(0);
            $table->integer('min_monetary_value')->default(0);
            $table->decimal('points_earning_rate', 8, 4)->default(1.0);
            $table->integer('points_expiry_days')->nullable();
            $table->json('benefits')->nullable();
            $table->json('perks')->nullable();
            $table->json('requirements')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(0);
            $table->string('badge_image')->nullable();
            $table->string('badge_color')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // فهارس
            $table->index(['code', 'is_active']);
            $table->index(['level', 'min_points_required']);
            $table->index(['is_active', 'level']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('loyalty_tiers');
    }
}
