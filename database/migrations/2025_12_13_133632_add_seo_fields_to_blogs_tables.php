<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoFieldsToBlogsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            // SEO Fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('og_image')->nullable();
            $table->string('twitter_image')->nullable();
            $table->string('schema_type')->nullable(); // Article, NewsArticle, etc.

            // AI & Rich Snippets JSONs
            $table->json('faq_json')->nullable();
            $table->json('how_to_json')->nullable();
            $table->json('breadcrumb_json')->nullable();
            $table->json('review_json')->nullable();
            $table->json('local_business_json')->nullable();

            // Content Optimization
            $table->json('target_keywords')->nullable();
            $table->string('ls_keyword')->nullable(); // Latent Semantic
            $table->json('semantic_topics')->nullable();
            $table->integer('word_count')->default(0);
            $table->float('flesch_score')->nullable();
            $table->float('sentiment_score')->nullable();

            // E-E-A-T
            $table->text('author_bio')->nullable();
            $table->text('author_credentials')->nullable();
            $table->json('sources_references')->nullable();
            $table->timestamp('last_updated')->nullable();
            $table->string('update_frequency')->nullable();

            // Performance
            $table->float('ctr')->nullable();
            $table->float('dwell_time')->nullable();
            $table->float('bounce_rate')->nullable();

            // Social & Backlinks
            $table->json('social_shares_count')->nullable();
            $table->integer('backlinks_count')->default(0);
            $table->integer('referring_domains')->default(0);
        });

        Schema::table('blog_categories', function (Blueprint $table) {
            // SEO Fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('schema_type')->nullable();
            $table->string('category_image')->nullable();
            $table->string('alt_text')->nullable();

            // E-A-T & Strategy
            $table->string('expertise_level')->nullable();
            $table->float('authority_score')->nullable();
            $table->json('trust_indicators')->nullable();
            $table->json('target_audience')->nullable();
            $table->json('content_focus')->nullable();

            // Performance
            $table->string('avg_read_time')->nullable();
            $table->float('engagement_rate')->nullable();
        });
    }

    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn([
                'meta_title',
                'meta_description',
                'meta_keywords',
                'canonical_url',
                'og_image',
                'twitter_image',
                'schema_type',
                'faq_json',
                'how_to_json',
                'breadcrumb_json',
                'review_json',
                'local_business_json',
                'target_keywords',
                'ls_keyword',
                'semantic_topics',
                'word_count',
                'flesch_score',
                'sentiment_score',
                'author_bio',
                'author_credentials',
                'sources_references',
                'last_updated',
                'update_frequency',
                'ctr',
                'dwell_time',
                'bounce_rate',
                'social_shares_count',
                'backlinks_count',
                'referring_domains'
            ]);
        });

        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropColumn([
                'meta_title',
                'meta_description',
                'meta_keywords',
                'canonical_url',
                'schema_type',
                'category_image',
                'alt_text',
                'expertise_level',
                'authority_score',
                'trust_indicators',
                'target_audience',
                'content_focus',
                'avg_read_time',
                'engagement_rate'
            ]);
        });
    }
}
