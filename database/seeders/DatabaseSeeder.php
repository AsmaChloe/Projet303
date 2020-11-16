<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        //$this->call(ECTableSeeder::class);
        //$this->call(NotesTableSeeder::class);
        //$this->call(GroupesTableSeeder::class);
        //$this->call(GroupeEtudiantTableSeeder::class);
        //$this->call(GroupeEnseignantTableSeeder::class);
        //$this->call(GroupeECTableSeeder::class);
        //$this->call(TypePresentielTableSeeder::class);
        $this->call(SeanceTableSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
