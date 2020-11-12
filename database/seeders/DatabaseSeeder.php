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
        //$this->call(ECTableSeeder::class);
        //$this->call(NotesTableSeeder::class);
        //$this->call(GroupesTableSeeder::class);
        //$this->call(GroupeEtudiantTableSeeder::class);
        //$this->call(GroupeEnseignantTableSeeder::class);
        $this->call(GroupeECTableSeeder::class);
    }
}
