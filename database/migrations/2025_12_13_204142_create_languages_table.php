<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique(); // ar, en, fr, etc.
            $table->string('name');
            $table->string('native_name');
            $table->string('direction', 3)->default('ltr'); // ltr, rtl
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->json('language_data')->nullable(); // locales, regions, etc.
            $table->timestamps();

            $table->index(['code', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
