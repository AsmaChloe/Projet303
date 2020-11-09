<?php

namespace Database\Seeders;

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
        //$this->call(\Database\Seeders\EtudiantTableSeeder::class);
        //$this->call(\Database\Seeders\ProfesseurTableSeeder::class);
        $this->call(\Database\Seeders\ResponsableTableSeeder::class);
    }
}
