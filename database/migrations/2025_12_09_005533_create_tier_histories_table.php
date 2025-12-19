<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTierHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('tier_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('old_tier')->nullable();
            $table->string('new_tier');
            $table->string('upgrade_reason')->nullable();
            $table->json('performance_data')->nullable();
            $table->decimal('bonus_awarded', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tier_histories');
    }
}
