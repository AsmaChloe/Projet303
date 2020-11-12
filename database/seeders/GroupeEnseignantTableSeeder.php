<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Groupe_Enseignants;

class GroupeEnseignantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Groupe_Enseignants::truncate();
        
        //Test de remplissage
        Groupe_Enseignants::create([
            'idGroupe' => 1, //1 : S3F CM
            'idUser' => 6 //6 : EnseignantD
        ]);
        Groupe_Enseignants::create([
            'idGroupe' => 2, //2 : S3F3 TD
            'idUser' => 6 //6 : EnseignantD
        ]);
        Groupe_Enseignants::create([
            'idGroupe' => 3, //3 : S3F3A TP
            'idUser' => 7 //7 : EnseignantE
        ]);
    }
}
