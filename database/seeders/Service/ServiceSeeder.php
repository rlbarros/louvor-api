<?php

namespace Database\Seeders\Service;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ServiceSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $jsonFile = base_path('database/seeders/data/service/services.json');

        // Read and decode the JSON file
        $jsonData = json_decode(File::get($jsonFile), true);

        $newjson = [];
        foreach ($jsonData as $jsonItem) {
            $date = Carbon::createFromFormat('Y-m-d\TH:i:s.v\Z', $jsonItem['day']);
            array_push($newjson, [
                'day' => $date->format('Y-m-d'),
                'id' => $jsonItem['id'],
                'ministry_id' => $jsonItem['ministry_id'],
                'service_type_id' => $jsonItem['service_type_id']
            ]);
        }

        // Insert data into the database
        DB::table('services')->insert($newjson);
    }
}
