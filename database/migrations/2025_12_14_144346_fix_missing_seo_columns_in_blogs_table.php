<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixMissingSeoColumnsInBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'meta_title')) {
                // SEO Fields
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->text('meta_keywords')->nullable();
                $table->string('canonical_url')->nullable();
                $table->string('og_image')->nullable();
                $table->string('twitter_image')->nullable();
                $table->string('schema_type')->nullable();

                // AI & Rich Snippets JSONs
                $table->json('faq_json')->nullable();
                $table->json('how_to_json')->nullable();
                $table->json('breadcrumb_json')->nullable();
                $table->json('review_json')->nullable();
                $table->json('local_business_json')->nullable();

                // Content Optimization
                $table->json('target_keywords')->nullable();
                $table->string('ls_keyword')->nullable();
                $table->json('semantic_topics')->nullable();
                $table->integer('word_count')->default(0);
                $table->float('flesch_score')->nullable();
                $table->float('sentiment_score')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            //
        });
    }
}
