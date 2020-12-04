<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Epreuve;

use \App\Models\EC;
use \App\Models\TypeEpreuve;

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

        $type=TypeEpreuve::all()->pluck('idTypeEpreuve');
        $nbEC=EC::count();
        $faker = \Faker\Factory::create();
        

        for($i=1;$i<=$nbEC;$i++){
            $temp=$faker->dateTimeBetween('now',"+6 months","Europe/Paris");
            Epreuve::create([
                'dateEpreuve'=>$temp->format('Y-m-d'),
                'debutEpreuve'=> '14:00:00' , 
                'finEpreuve'=> '16:00:00' ,
                'numSession'=>1,
                'pourcentage'=>100, 
                'idEC'=>$i,
                'idTypeEpreuve' => $faker->randomElement($type)
            ]);
        }
        
    }
}
