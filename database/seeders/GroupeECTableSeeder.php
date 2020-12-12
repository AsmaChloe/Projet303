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

        //INFORMATIQUE

        //Les CM
        EC_Groupe::create([
            'idEC' => 1, //1 : INFO0301
            'idGroupe' => 1 //1 : S3F CM
        ]);

        for($i=3;$i<=6;$i++){
            EC_Groupe::create([
                'idEC' => $i, //INFO030?
                'idGroupe' => 1 //1 : S3F CM
            ]);
        }

        //Les TD

        //Les TD de S3F3
        EC_Groupe::create([
            'idEC' => 1, //1 : INFO0301
            'idGroupe' => 2 //2 : S3F3 TD
        ]);

        for($i=3;$i<=6;$i++){
            EC_Groupe::create([
                'idEC' => $i, //INFO030?
                'idGroupe' => 2 //2 : S3F3 TD
            ]);
        }

        //Les TP de S3F3A & S3F3B
        for($j=3;$j<=4;$j++){
            for($i=1;$i<=6;$i++){
                EC_Groupe::create([
                    'idEC' => $i, 
                    'idGroupe' => $j
                ]);
            }
        }
        
        //MATHS

        for($i=5;$i<=8;$i++){
            for($j=7;$j<=11;$j++){
                EC_Groupe::create([
                    'idEC' => $j, //MA70?
                    'idGroupe' => $i //Les groupes
                ]);
            }
        }
    }
}

