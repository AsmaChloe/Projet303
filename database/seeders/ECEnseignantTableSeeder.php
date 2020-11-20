<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Ec_Enseignant;
use \App\Models\User;

class ECEnseignantTableSeeder extends Seeder
{
    /**
     * peuplement de la table ec__enseignants
     *
     * @return void
     */
    public function run()
    {
        Ec_Enseignant::truncate();

        //Test
        $nbProf=User::where('role',2)->count();

        for($i=1;$i<=$nbProf;$i++){
            Ec_Enseignant::create(['idEC'=>$i,'idEnseignant'=>$i]);
        }
    }
}
