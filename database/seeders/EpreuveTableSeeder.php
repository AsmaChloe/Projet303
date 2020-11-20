<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Epreuve;

use \App\Models\EC;

class EpreuveTableSeeder extends Seeder
{
    /**
     * Peuplement de la table epreuves
     *
     * @return void
     */
    public function run()
    {
        //Remarque : l'horaire de l'épreuve
        Epreuve::truncate();

        $nbEC=EC::count();
        $faker = \Faker\Factory::create();

        for($i=1;$i<=$nbEC;$i++){
            Epreuve::create([
                'dateEpreuve'=>$faker->dateTimeBetween('now',"+6 months","Europe/Paris")->format('Y-m-d H:i:s'),
                'dureeEpreuve'=>120, 
                'numSession'=>1,
                'pourcentage'=>100, 
                'idEC'=>$i
            ]);
        }
        
    }
}
