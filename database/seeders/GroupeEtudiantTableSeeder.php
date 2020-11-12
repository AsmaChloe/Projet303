<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Groupe_Etudiants;

class GroupeEtudiantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Remplissage pour le test
        Groupe_Etudiants::truncate();

        //Groupe de CM = tout le monde
        Groupe_Etudiants::create([
            'idGroupe' => 1, //1 = S3F, groupe de CM
            'idUser' => 3 //3 = eleveA
        ]);
        Groupe_Etudiants::create([
            'idGroupe' => 1, //1 = S3F, groupe de CM
            'idUser' => 4 //4 = eleveB
        ]);
        Groupe_Etudiants::create([
            'idGroupe' => 1, //1 = S3F, groupe de CM
            'idUser' => 5 //5 = eleveC
        ]);

        //Groupe de TD
        Groupe_Etudiants::create([
            'idGroupe' => 2, //1 = S3F3, groupe de TD
            'idUser' => 3 //3 = eleveA
        ]);
        Groupe_Etudiants::create([
            'idGroupe' => 2, //1 = S3F3, groupe de TD
            'idUser' => 4 //4 = eleveB
        ]);

        //Groupe de TP
        Groupe_Etudiants::create([
            'idGroupe' => 3, //1 = S3F3A, groupe de TP
            'idUser' => 3 //3 = eleveA
        ]);
    }
}
