<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Groupe_Enseignants;

class GroupeEnseignantTableSeeder extends Seeder
{
    /**
     * peuplement de la base de donnée groupe_enseignants
     *
     * @return void
     */
    public function run()
    {
        Groupe_Enseignants::truncate();

        //a voir

    }
}
