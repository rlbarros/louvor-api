<?php

namespace Database\Seeders;

use App\Models\Service\ServiceType;
use Database\Seeders\Music\GenreSeeder;
use Database\Seeders\Music\InterpreterSeeder;
use Database\Seeders\Music\MusicSeeder;
use Database\Seeders\Music\StyleSeeder;
use Database\Seeders\Service\ServiceMusicSeeder;
use Database\Seeders\Service\ServiceSeeder;
use Database\Seeders\Service\ServiceTypeSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Rodrigo',
        //     'email' => 'rodrigo.lima.barros@gmail.com',
        // ]);
        $this->call(MinistrySeeder::class);
        $this->call(UserSeeder::class);

        $this->call(StyleSeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(InterpreterSeeder::class);
        $this->call(MusicSeeder::class);

        $this->call(ServiceTypeSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(ServiceMusicSeeder::class);
    }
}
