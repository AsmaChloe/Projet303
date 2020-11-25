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

        //Les CM de 301,303,304,305,306
        Seance::create([
            'debutSeance' => $faker->dateTimeBetween('-1 months',"now","UTC")->format('Y-m-d H:i:s'),
            'finSeance' => $faker->dateTimeBetween('-1 months',"now","UTC")->format('Y-m-d H:i:s'),
            'idGroupe' => 1,
            'idEC' => 1
        ]);

        for($i=3;$i<=6;$i++){
            Seance::create([
                'debutSeance' => $faker->dateTimeBetween('-1 months',"now","UTC")->format('Y-m-d H:i:s'),
                'finSeance' => $faker->dateTimeBetween('-1 months',"now","UTC")->format('Y-m-d H:i:s'),
                'idGroupe' => 1,
                'idEC' => $i
            ]);
        }

        //Les TD pour le groupe S3F3 de 301 à 306
        Seance::create([
            'debutSeance' => $faker->dateTimeBetween('-1 months',"now","UTC")->format('Y-m-d H:i:s'),
            'finSeance' => $faker->dateTimeBetween('-1 months',"now","UTC")->format('Y-m-d H:i:s'),
            'idGroupe' => 2,
            'idEC' => 1
        ]);

        for($i=3;$i<=6;$i++){
            Seance::create([
                'debutSeance' => $faker->dateTimeBetween('-1 months',"now","UTC")->format('Y-m-d H:i:s'),
                'finSeance' => $faker->dateTimeBetween('-1 months',"now","UTC")->format('Y-m-d H:i:s'),
                'idGroupe' => 2,
                'idEC' => $i
            ]);
        }

        //Les TP pour le groupe S3F3A de 301 à 306
        for($i=1;$i<=6;$i++){
            Seance::create([
                'debutSeance' => $faker->dateTimeBetween('-1 months',"now","UTC")->format('Y-m-d H:i:s'),
                'finSeance' => $faker->dateTimeBetween('-1 months',"now","UTC")->format('Y-m-d H:i:s'),
                'idGroupe' => 4,
                'idEC' => $i
            ]);
        }
    }
}
