<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->mediumText('discreption')->nullable();
            $table->longText('sdiscreption')->nullable();
            $table->string('photo');
            $table->enum('status',['active','inactive'])->default('active');
            $table->string('youtubeUrl')->nullable();
            $table->string('mainImg')->nullable();
            $table->string('testim_caption')->nullable();
            $table->string('team_caption')->nullable();
            $table->string('no1')->nullable();
            $table->string('text1')->nullable();
            $table->string('no2')->nullable();
            $table->string('text2')->nullable();
            $table->string('no3')->nullable();
            $table->string('text3')->nullable();
            $table->string('no4')->nullable();
            $table->string('text4')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('text5')->nullable();
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
        Schema::dropIfExists('abouts');
    }
}
