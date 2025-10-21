<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserTableSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call([
            SpecialtySeeder::class,
            MedicalCenterSeeder::class,


            DoctorSeeder::class,    // الأطباء
            CategoriesSeeder::class,
            ScheduleSeeder::class,
            // باقي الـ Seeders...
        ]);





        //$this->call(CountrySeeder::class);
        //\App\Models\User::factory(20)->create();
        \App\Models\Brand::factory(20)->create();
        \App\Models\art::factory(20)->create();
        \App\Models\client::factory(20)->create();
        //\App\Models\setting::factory(2)->create();
        \App\Models\team::factory(10)->create();
        \App\Models\Branch::factory(10)->create();
        \App\Models\testim::factory(10)->create();
        \App\Models\Banner::factory(10)->create();
        \App\Models\about::factory(10)->create();
        // \App\Models\shipment_owners::factory(10)->create();
        // \App\Models\shipments::factory(10)->create();

        // \App\Models\truck_owners::factory(10)->create();

        // \App\Models\trucks::factory(50)->create();
        // \App\Models\LoadPackage::factory(50)->create();
        // \App\Models\truckPhoto::factory(50)->create();
        // \App\Models\TruckAvailability::factory(20)->create();
        // \App\Models\TruckRating::factory(30)->create();
        // \App\Models\TruckSpecification::factory(30)->create();
    }
}
