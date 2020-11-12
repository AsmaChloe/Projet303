<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Groupe_EC;

class GroupeECTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Groupe_EC::truncate();

        //Test de remplissage

        //Les CM
        Groupe_EC::create([
            'idEC' => 1, //1 : INFO0301
            'idGroupe' => 1 //1 : S3F CM
        ]);
        Groupe_EC::create([
            'idEC' => 3, //3 : INFO0303
            'idGroupe' => 1 //1 : S3F CM
        ]);
        Groupe_EC::create([
            'idEC' => 4, //4 : INFO0304
            'idGroupe' => 1 //1 : S3F CM
        ]);
        Groupe_EC::create([
            'idEC' => 5, //5 : INFO0305
            'idGroupe' => 1 //1 : S3F CM
        ]);
        Groupe_EC::create([
            'idEC' => 6, //6 : INFO0306
            'idGroupe' => 1 //1 : S3F CM
        ]);

        //Les TD
        Groupe_EC::create([
            'idEC' => 1, //1 : INFO0301
            'idGroupe' => 2 //2 : S3F3 TD
        ]);
        Groupe_EC::create([
            'idEC' => 3, //3 : INFO0303
            'idGroupe' => 2 //2 : S3F3 TD
        ]);
        Groupe_EC::create([
            'idEC' => 4, //4 : INFO0304
            'idGroupe' => 2 //2 : S3F3 TD
        ]);
        Groupe_EC::create([
            'idEC' => 5, //5 : INFO0305
            'idGroupe' => 2 //2 : S3F3 TD
        ]);
        Groupe_EC::create([
            'idEC' => 6, //6 : INFO0306
            'idGroupe' => 2 //2 : S3F3 TD
        ]);

        //Les TP
        Groupe_EC::create([
            'idEC' => 1, //1 : INFO0301
            'idGroupe' => 3 //3 : S3F3A TP
        ]);
        Groupe_EC::create([
            'idEC' => 2, //2 : INFO0302
            'idGroupe' => 3 //3 : S3F3A TP
        ]);
        Groupe_EC::create([
            'idEC' => 3, //3 : INFO0303
            'idGroupe' => 3 //3 : S3F3A TP
        ]);
        Groupe_EC::create([
            'idEC' => 4, //4 : INFO0304
            'idGroupe' => 3 //3 : S3F3A TP
        ]);
        Groupe_EC::create([
            'idEC' => 5, //5 : INFO0305
            'idGroupe' => 3 //3 : S3F3A TP
        ]);
        Groupe_EC::create([
            'idEC' => 6, //6 : INFO0306
            'idGroupe' => 3 //3 : S3F3A TP
        ]);
    }
}
