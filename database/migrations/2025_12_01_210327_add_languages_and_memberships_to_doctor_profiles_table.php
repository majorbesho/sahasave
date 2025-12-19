<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLanguagesAndMembershipsToDoctorProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->json('languages')->nullable()->after('subspecialties');
            $table->json('memberships')->nullable()->after('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropColumn(['languages', 'memberships']);
        });
    }
}
