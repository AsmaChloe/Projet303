<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\diplome_responsable;
use \App\Models\User;
use \App\Models\Diplomes;

class DiplomeResponsableTableSeeder extends Seeder
{
    /**
     * Peuplement de la table diplome_responsables
     *
     * @return void
     */
    public function run()
    {
        diplome_responsable::truncate();

        $nbDiplome=Diplomes::count();
        $idResponsable=User::where('role',1)->get();
        $faker = \Faker\Factory::create();

        for($i=1;$i<=$nbDiplome;$i++){
            diplome_responsable::create(['idDiplome'=>$i,'idResponsable'=>$faker->randomElement($idResponsable)->id]);
        }
    }
}

