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

        //$this->call(TypePresentielTableSeeder::class);
        //$this->call(UserTableSeeder::class);
        //$this->call(DiplomeTableSeeder::class);
        //$this->call(ParcoursTableSeeder::class);
        //$this->call(SemestreTableSeeder::class);
        //$this->call(ECTableSeeder::class);
        //$this->call(IPTableSeeder::class);
        //$this->call(EpreuveTableSeeder::class);
        //$this->call(NotesTableSeeder::class);
        //$this->call(GroupesTableSeeder::class);
        //$this->call(GroupeEtudiantTableSeeder::class);
        //$this->call(GroupeEnseignantTableSeeder::class);
        //$this->call(GroupeECTableSeeder::class);
        //$this->call(SeanceTableSeeder::class);
        //$this->call(DiplomeResponsableTableSeeder::class);
        //$this->call(ParcoursSemestreTableSeeder::class);
        $this->call(ECEnseignantTableSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
