<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Enseignant_Groupe;
use \App\Models\Groupes;
use \App\Models\User;

class EnseignantGroupeTableSeeder extends Seeder
{
    /**
     * peuplement de la base de donnée Enseignant_Groupe
     *
     * @return void
     */
    public function run()
    {
        //test pour les groupes de CM
        Enseignant_Groupe::truncate();
        
        Enseignant_Groupe::create([
            'idEnseignant'=> 13,
           'idGroupe'=> 1
        ]); //CM(S3F) de 301 avec Enseignant 1

        Enseignant_Groupe::create([
            'idEnseignant'=> 15,
           'idGroupe'=> 1
        ]); //CM(S3F) de 303 avec Enseignant 3

        Enseignant_Groupe::create([
            'idEnseignant'=> 16,
           'idGroupe'=> 1
        ]); //CM(S3F) de 304 avec Enseignant 4

        Enseignant_Groupe::create([
            'idEnseignant'=> 17,
           'idGroupe'=> 1
        ]); //CM(S3F) de 305 avec Enseignant 5

        Enseignant_Groupe::create([
            'idEnseignant'=> 13,
           'idGroupe'=> 1
        ]); //CM(S3F) de 306 avec Enseignant 1
    }
}
