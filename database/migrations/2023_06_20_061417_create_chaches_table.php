<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chaches', function (Blueprint $table) {
            $table->id();
            $table->string('empid')->require();
            $table->string('ticketno')->nullable();
            $table->string('user_id')->nullable();
            $table->string('bookheaderCode')->nullable();
            $table->integer('paperCode')->nullable();
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
        Schema::dropIfExists('chaches');
    }
}
