<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('medical_centers', function (Blueprint $table) {
            if (!Schema::hasColumn('medical_centers', 'address_ar')) {
                $table->string('address_ar')->nullable()->after('address');
            }
            if (!Schema::hasColumn('medical_centers', 'city_ar')) {
                $table->string('city_ar')->nullable()->after('city');
            }
            if (!Schema::hasColumn('medical_centers', 'state_ar')) {
                $table->string('state_ar')->nullable()->after('state');
            }
            if (!Schema::hasColumn('medical_centers', 'country_ar')) {
                $table->string('country_ar')->nullable()->after('country');
            }
            if (!Schema::hasColumn('medical_centers', 'services_ar')) {
                $table->json('services_ar')->nullable()->after('services');
            }
            if (!Schema::hasColumn('medical_centers', 'facilities_ar')) {
                $table->json('facilities_ar')->nullable()->after('facilities');
            }
            if (!Schema::hasColumn('medical_centers', 'insurance_providers_ar')) {
                $table->json('insurance_providers_ar')->nullable()->after('insurance_providers');
            }
        });
    }

    public function down()
    {
        Schema::table('medical_centers', function (Blueprint $table) {
            $table->dropColumn([
                'address_ar',
                'city_ar',
                'state_ar',
                'country_ar',
                'services_ar',
                'facilities_ar',
                'insurance_providers_ar'
            ]);
        });
    }
};
