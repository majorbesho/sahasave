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
        Schema::table('reward_transactions', function (Blueprint $table) {
            // Drop the incorrect foreign key constraint
            $table->dropForeign(['reward_id']);

            // Add the correct foreign key constraint pointing to rewards table
            $table->foreign('reward_id')->references('id')->on('rewards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reward_transactions', function (Blueprint $table) {
            // Revert back to the original (incorrect) constraint
            $table->dropForeign(['reward_id']);
            $table->foreign('reward_id')->references('id')->on('reward_programs')->onDelete('cascade');
        });
    }
};
