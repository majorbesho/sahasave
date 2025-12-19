<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('tag_type', ['topic', 'symptom', 'treatment', 'specialty', 'location', 'disease']);
            $table->json('related_tags')->nullable();
            $table->json('synonyms')->nullable(); // For semantic search
            $table->integer('usage_count')->default(0);
            $table->float('search_volume')->nullable();
            $table->float('competition_score')->nullable();
            $table->json('trend_data')->nullable(); // Monthly search trends
            $table->timestamps();

            $table->index(['tag_type', 'usage_count']);
            // Fulltext if supported by engine
            // $table->fullText(['name', 'description']); 
        });

        // Pivot table: blog_tag
        Schema::create('blog_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('tag_id');
            $table->float('relevance_score')->default(1.0);
            $table->integer('position_in_content')->nullable();
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('blog_tags')->onDelete('cascade');
            $table->unique(['blog_id', 'tag_id']);
            $table->index(['tag_id', 'relevance_score']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_tags');
    }
}
