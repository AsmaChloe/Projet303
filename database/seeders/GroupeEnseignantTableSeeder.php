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
        //test
        Groupe_Enseignants::truncate();

        for($i=1;$i<=6;$i++){
            Groupe_Enseignants::create([
                'idEnseignant' =>$i,
                'idGroupe'=>$i
            ]);
        }

    }
}
