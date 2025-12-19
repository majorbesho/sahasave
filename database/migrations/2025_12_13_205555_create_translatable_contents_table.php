<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslatableContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translatable_contents', function (Blueprint $table) {
            $table->id();
            $table->string('translatable_type');
            $table->unsignedBigInteger('translatable_id');
            $table->string('locale', 10);
            $table->string('key'); // e.g., 'title', 'content', 'excerpt'
            $table->longText('value')->nullable();
            $table->timestamps();

            $table->index(['translatable_type', 'translatable_id']);
            $table->index(['locale', 'key']);
            $table->unique(['translatable_type', 'translatable_id', 'locale', 'key'], 'translatable_content_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translatable_contents');
    }
}
