<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Groupes;
use \App\Models\Seance;

class SeanceTableSeeder extends Seeder
{
    /**
     * Peuplement de la table seances
     *
     * @return void
     */
    public function run()
    {
        //Test
        Seance::truncate();
        
        $faker = \Faker\Factory::create();
        $temp=$faker->dateTimeBetween('now',"+6 months","Europe/Paris");

        //Les CM de 301,303,304,305,306
        Seance::create([
            'numSeance'=>1,
            'dateSeance'=>$temp->format('Y-m-d'),
            'debutSeance'=> '14:00:00', 
            'finSeance'=> '16:00:00',
            'idGroupe' => 1,
            'idEC' => 1
        ]);

        for($i=3;$i<=6;$i++){
            $temp=$faker->dateTimeBetween('now',"+6 months","Europe/Paris");
            Seance::create([
                'numSeance'=>1,
                'dateSeance'=>$temp->format('Y-m-d'),
                'debutSeance'=> '14:00:00', 
                'finSeance'=> '16:00:00',
                'idGroupe' => 1,
                'idEC' => $i
            ]);
        }

        //Les TD pour le groupe S3F3 de 301 à 306
        Seance::create([
            'numSeance'=>1,
            'dateSeance'=>$temp->format('Y-m-d'),
            'debutSeance'=> '14:00:00', 
            'finSeance'=> '16:00:00',
            'idGroupe' => 2,
            'idEC' => 1
        ]);

        for($i=3;$i<=6;$i++){
            $temp=$faker->dateTimeBetween('now',"+6 months","Europe/Paris");
            Seance::create([
                'numSeance'=>1,
                'dateSeance'=>$temp->format('Y-m-d'),
                'debutSeance'=> '14:00:00', 
                'finSeance'=> '16:00:00',
                'idGroupe' => 2,
                'idEC' => $i
            ]);
        }

        //Les TP pour le groupe S3F3A de 301 à 306
        for($i=1;$i<=6;$i++){
            $temp=$faker->dateTimeBetween('now',"+6 months","Europe/Paris");
            Seance::create([
                'numSeance'=>1,
                'dateSeance'=>$temp->format('Y-m-d'),
                'debutSeance'=> '14:00:00', 
                'finSeance'=> '16:00:00',
                'idGroupe' => 4,
                'idEC' => $i
            ]);
        }
    }
}
