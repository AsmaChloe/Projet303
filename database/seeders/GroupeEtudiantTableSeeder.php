<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Groupe_Etudiants;
use \App\Models\User;

class GroupeEtudiantTableSeeder extends Seeder
{
    /**
     * Peuplement de la table groupe_etudiants
     *
     * @return void
     */
    public function run()
    {
        Groupe_Etudiants::truncate();
        
        //Test
        
        //Informatique
        //CM
        for($i=3;$i<=7;$i++){
            Groupe_Etudiants::create([
                'idGroupe' => 1, //1 = S3F, groupe de CM
                'idEtudiant' => $i
            ]);
        }
        //TD
        for($i=3;$i<=5;$i++){
            Groupe_Etudiants::create([
                'idGroupe' => 2, //2 = S3F3, groupe de TD
                'idEtudiant' => $i
            ]);
        }

        //TP
        for($i=3;$i<=4;$i++){
            Groupe_Etudiants::create([
                'idGroupe' => 3, //3 = S3F3A, groupe de TP
                'idEtudiant' => $i
            ]);
        }
        
            Groupe_Etudiants::create([
                'idGroupe' => 4, //4 = S3F3B, groupe de TP
                'idEtudiant' => 5
            ]);


        //Mathematiques
        //CM
        for($i=8;$i<=12;$i++){
            Groupe_Etudiants::create([
                'idGroupe' => 5, //5 = B1F, groupe de CM
                'idEtudiant' => $i
            ]);
        }

        //TD
        for($i=8;$i<=10;$i++){
            Groupe_Etudiants::create([
                'idGroupe' => 6, //6 = B1F1, groupe de TD
                'idEtudiant' => $i
            ]);
        }

        //TP
        for($i=8;$i<=9;$i++){
            Groupe_Etudiants::create([
                'idGroupe' => 7, //7 = B1F1A, groupe de TP
                'idEtudiant' => $i
            ]);
        }

        Groupe_Etudiants::create([
            'idGroupe' => 8, //8 = B1F1B, groupe de TP
            'idEtudiant' => 10
        ]);
    }
}
