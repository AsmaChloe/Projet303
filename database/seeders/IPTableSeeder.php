<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\IP;

class IPTableSeeder extends Seeder
{
    /**
     * Peuplement de la table i_p_s
     *
     * @return void
     */
    public function run()
    {
        IP::truncate();

        //Pour le test

        //Etudiants infos
        for($i=3;$i<=7;$i++){
            //Matiere d'info
            for($j=1;$j<=6;$j++){
                IP::create(['idEC'=>$j,'idEtudiant'=>$i]);
            }
        }
        
        //Etudiants maths
        for($i=8;$i<=12;$i++){
            //Matiere de maths
            for($j=7;$j<=11;$j++){
                IP::create(['idEC'=>$j,'idEtudiant'=>$i]);
            }
        }

    }
}
