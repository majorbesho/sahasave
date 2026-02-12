<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoAndTrustColumnsToBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            // E-E-A-T Fields
            if (!Schema::hasColumn('blogs', 'author_credentials')) {
                $table->string('author_credentials')->nullable();
            }
            if (!Schema::hasColumn('blogs', 'sources_references')) {
                $table->json('sources_references')->nullable();
            }

            // Performance Tracking
            if (!Schema::hasColumn('blogs', 'ctr')) {
                $table->float('ctr')->nullable();
            }
            if (!Schema::hasColumn('blogs', 'dwell_time')) {
                $table->integer('dwell_time')->nullable();
            }
            if (!Schema::hasColumn('blogs', 'bounce_rate')) {
                $table->float('bounce_rate')->nullable();
            }

            // Social & Backlinks
            if (!Schema::hasColumn('blogs', 'social_shares_count')) {
                $table->json('social_shares_count')->nullable();
            }
            if (!Schema::hasColumn('blogs', 'backlinks_count')) {
                $table->integer('backlinks_count')->nullable()->default(0);
            }
            if (!Schema::hasColumn('blogs', 'referring_domains')) {
                $table->integer('referring_domains')->nullable()->default(0);
            }

            // E-E-A-T Details
            if (!Schema::hasColumn('blogs', 'author_bio')) {
                $table->text('author_bio')->nullable();
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
            $table->dropColumn([
                'author_credentials',
                'sources_references',
                'ctr',
                'dwell_time',
                'bounce_rate',
                'social_shares_count',
                'backlinks_count',
                'referring_domains',
                'author_bio',
            ]);
        });
    }
}
