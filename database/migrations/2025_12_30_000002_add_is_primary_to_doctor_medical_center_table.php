<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPrimaryToDoctorMedicalCenterTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('doctor_medical_center')) {
            Schema::table('doctor_medical_center', function (Blueprint $table) {
                if (!Schema::hasColumn('doctor_medical_center', 'is_primary')) {
                    $table->boolean('is_primary')->default(false);
                }
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('doctor_medical_center')) {
            Schema::table('doctor_medical_center', function (Blueprint $table) {
                if (Schema::hasColumn('doctor_medical_center', 'is_primary')) {
                    $table->dropColumn('is_primary');
                }
            });
        }
    }
}
