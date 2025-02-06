<?php

namespace Database\Seeders\Music;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GenreSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $jsonFile = base_path('database/seeders/data/music/genres.json');

        // Read and decode the JSON file
        $jsonData = json_decode(File::get($jsonFile), true);

        // Insert data into the database
        DB::table('genres')->insert($jsonData);
    }
}
