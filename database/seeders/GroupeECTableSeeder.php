<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\EC_Groupe;

class GroupeECTableSeeder extends Seeder
{
    /**
     * Peuplement de la table EC_Groupes
     *
     * @return void
     */
    public function run()
    {
        EC_Groupe::truncate();

        //Test sur une partie seulement

        //Les CM
        EC_Groupe::create([
            'idEC' => 1, //1 : INFO0301
            'idGroupe' => 1 //1 : S3F CM
        ]);
        EC_Groupe::create([
            'idEC' => 3, //3 : INFO0303
            'idGroupe' => 1 //1 : S3F CM
        ]);
        EC_Groupe::create([
            'idEC' => 4, //4 : INFO0304
            'idGroupe' => 1 //1 : S3F CM
        ]);
        EC_Groupe::create([
            'idEC' => 5, //5 : INFO0305
            'idGroupe' => 1 //1 : S3F CM
        ]);
        EC_Groupe::create([
            'idEC' => 6, //6 : INFO0306
            'idGroupe' => 1 //1 : S3F CM
        ]);

        //Les TD
        EC_Groupe::create([
            'idEC' => 1, //1 : INFO0301
            'idGroupe' => 2 //2 : S3F3 TD
        ]);
        EC_Groupe::create([
            'idEC' => 3, //3 : INFO0303
            'idGroupe' => 2 //2 : S3F3 TD
        ]);
        EC_Groupe::create([
            'idEC' => 4, //4 : INFO0304
            'idGroupe' => 2 //2 : S3F3 TD
        ]);
        EC_Groupe::create([
            'idEC' => 5, //5 : INFO0305
            'idGroupe' => 2 //2 : S3F3 TD
        ]);
        EC_Groupe::create([
            'idEC' => 6, //6 : INFO0306
            'idGroupe' => 2 //2 : S3F3 TD
        ]);

        //Les TP
        EC_Groupe::create([
            'idEC' => 1, //1 : INFO0301
            'idGroupe' => 3 //3 : S3F3A TP
        ]);
        EC_Groupe::create([
            'idEC' => 2, //2 : INFO0302
            'idGroupe' => 3 //3 : S3F3A TP
        ]);
        EC_Groupe::create([
            'idEC' => 3, //3 : INFO0303
            'idGroupe' => 3 //3 : S3F3A TP
        ]);
        EC_Groupe::create([
            'idEC' => 4, //4 : INFO0304
            'idGroupe' => 3 //3 : S3F3A TP
        ]);
        EC_Groupe::create([
            'idEC' => 5, //5 : INFO0305
            'idGroupe' => 3 //3 : S3F3A TP
        ]);
        EC_Groupe::create([
            'idEC' => 6, //6 : INFO0306
            'idGroupe' => 3 //3 : S3F3A TP
        ]);
    }
}
