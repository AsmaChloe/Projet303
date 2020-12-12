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
        
        
        for($i=1;$i<=6;$i++){
            for($j=1;$j<=4;$j++){
                $temp=$faker->dateTimeBetween('now',"+6 months","Europe/Paris");
                Seance::create([
                    'numSeance'=>1,
                    'dateSeance'=>$temp->format('Y-m-d'),
                    'debutSeance'=> '14:00:00', 
                    'finSeance'=> '16:00:00',
                    'idGroupe' => $j,
                    'idEC' => $i
                ]);
            }
        }


        for($i=7;$i<=11;$i++){
            for($j=5;$j<=8;$j++){
                $temp=$faker->dateTimeBetween('now',"+6 months","Europe/Paris");
                Seance::create([
                    'numSeance'=>1,
                    'dateSeance'=>$temp->format('Y-m-d'),
                    'debutSeance'=> '14:00:00', 
                    'finSeance'=> '16:00:00',
                    'idGroupe' => $j,
                    'idEC' => $i
                ]);
            }
        }
    }
}
