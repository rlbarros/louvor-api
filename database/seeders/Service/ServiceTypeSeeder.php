<?php

namespace Database\Seeders\Service;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $jsonFile = base_path('database/seeders/data/service/service-types.json');

        // Read and decode the JSON file
        $jsonData = json_decode(File::get($jsonFile), true);

        // Insert data into the database
        DB::table('service_types')->insert($jsonData);
    }
}
