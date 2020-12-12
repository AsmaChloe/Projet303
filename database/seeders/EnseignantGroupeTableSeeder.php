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

        Enseignant_Groupe::truncate();
        
        Enseignant_Groupe::create([
            'idEnseignant'=> 18,
           'idGroupe'=> 1
        ]); //S3F avec Enseignant 6

        Enseignant_Groupe::create([
            'idEnseignant'=> 13,
           'idGroupe'=> 2
        ]); //S3F3 avec Enseignant 1

        Enseignant_Groupe::create([
            'idEnseignant'=> 14,
           'idGroupe'=> 3
        ]); //S3F3A avec Enseignant 2

        
        Enseignant_Groupe::create([
            'idEnseignant'=> 15,
           'idGroupe'=> 4
        ]); //S3F3B avec Enseignant 3

        
        Enseignant_Groupe::create([
            'idEnseignant'=> 16,
           'idGroupe'=> 5
        ]); //B1F avec Enseignant 4

        Enseignant_Groupe::create([
            'idEnseignant'=> 17,
           'idGroupe'=> 6
        ]); //B1F1 avec Enseignant 5

        Enseignant_Groupe::create([
            'idEnseignant'=> 19,
           'idGroupe'=> 7
        ]); //B1F1A avec Enseignant 7

        Enseignant_Groupe::create([
            'idEnseignant'=> 19,
           'idGroupe'=> 8
        ]); //B1F1B avec Enseignant 7

    }
}