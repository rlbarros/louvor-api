<?php

namespace Database\Seeders;

use App\Models\Ministry;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MinistrySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Ministry::factory()->create([
            'name' => 'IEA Loteamento Brasil'
        ]);
    }
}
