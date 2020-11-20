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
        //Remarque : fin de seance apres le debut
        //Test
        Seance::truncate();
        
        $faker = \Faker\Factory::create();
        $nbGroupe = Groupes::count();

        for($i=1;$i<=$nbGroupe;$i++){
            Seance::create([
            'debutSeance' => $faker->dateTimeBetween('now',"+6 months","UTC")->format('Y-m-d H:i:s'),
            'finSeance' => $faker->dateTimeBetween('now',"+6 months","UTC")->format('Y-m-d H:i:s'),
            'idGroupe' => $i
        ]);
        }
        
    }
}
