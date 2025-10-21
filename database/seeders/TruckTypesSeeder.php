<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\TruckType;
use App\Models\TruckSubType;

class TruckTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Traila type
        $traila = TruckType::create([
            'name' => 'Traila',
            'description' => 'Large capacity trailers for heavy loads',
            'status' => 'active'
        ]);

        $trailaSubTypes = [
            ['name' => 'Flatbed', 'capacity' => '25 ton'],
            ['name' => 'Short sides', 'capacity' => '25 ton'],
            ['name' => 'High Sides', 'capacity' => '25 ton'],
            ['name' => 'Curtain', 'capacity' => '25 ton'],
            ['name' => 'Refrigerator', 'capacity' => '25 ton']
        ];

        foreach ($trailaSubTypes as $subType) {
            TruckSubType::create([
                'truck_type_id' => $traila->id,
                'name' => $subType['name'],
                'capacity' => $subType['capacity'],
                'status' => 'active'
            ]);
        }

        // Lorry type
        $lorry = TruckType::create([
            'name' => 'lorry',
            'description' => 'Medium capacity trucks',
            'status' => 'active'
        ]);

        $lorrySubTypes = [
            ['name' => 'Sides', 'capacity' => '8 ton'],
            ['name' => 'Closed', 'capacity' => '8 ton'],
            ['name' => 'Freezer', 'capacity' => '8 ton']
        ];

        foreach ($lorrySubTypes as $subType) {
            TruckSubType::create([
                'truck_type_id' => $lorry->id,
                'name' => $subType['name'],
                'capacity' => $subType['capacity'],
                'status' => 'active'
            ]);
        }

        // Diana type
        $diana = TruckType::create([
            'name' => 'Diana',
            'description' => 'Small capacity trucks',
            'status' => 'active'
        ]);

        $dianaSubTypes = [
            ['name' => 'Sides', 'capacity' => '5 ton'],
            ['name' => 'Closed', 'capacity' => '5 ton'],
            ['name' => 'Refrigerator', 'capacity' => '5 ton']
        ];

        foreach ($dianaSubTypes as $subType) {
            TruckSubType::create([
                'truck_type_id' => $diana->id,
                'name' => $subType['name'],
                'capacity' => $subType['capacity'],
                'status' => 'active'
            ]);
        }

        // Other type
        $other = TruckType::create([
            'name' => 'other',
            'description' => 'Other types of trucks',
            'status' => 'active'
        ]);
    }
}
