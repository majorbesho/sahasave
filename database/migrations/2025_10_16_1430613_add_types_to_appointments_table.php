<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypesToAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            //

            $table->enum('appointment_type', ['video', 'audio', 'chat', 'in-person'])->default('in-person')->after('status');
            $table->string('visit_type')->default('General')->after('appointment_type'); // string for flexibility

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            //
            $table->dropColumn(['appointment_type', 'visit_type']);
        });
    }
}
