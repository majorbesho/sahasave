<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'last_updated')) {
                $table->timestamp('last_updated')->nullable();
            }
            if (!Schema::hasColumn('blogs', 'update_frequency')) {
                $table->string('update_frequency')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (Schema::hasColumn('blogs', 'last_updated')) {
                $table->dropColumn('last_updated');
            }
            if (Schema::hasColumn('blogs', 'update_frequency')) {
                $table->dropColumn('update_frequency');
            }
        });
    }
};
