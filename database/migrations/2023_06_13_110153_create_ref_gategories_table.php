<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefGategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_gategories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('photo')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->string('reward')->nullable();
            $table->string('congratulatory_message')->nullable();
            $table->string('taget_no_ref')->nullable();
            $table->string('point_per_ref')->nullable();
            $table->string('user_id')->nullable();
            $table->integer('ref_count')->nullable()->default(0);
            $table->integer('ref_viset')->nullable()->default(0);
            $table->integer('ref_buy')->nullable()->default(0);
            $table->enum('status',['active','inactive'])->default('active');






            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_gategories');
    }
}
