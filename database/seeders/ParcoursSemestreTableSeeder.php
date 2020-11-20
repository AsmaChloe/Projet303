<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\ParcoursSemestre;

class ParcoursSemestreTableSeeder extends Seeder
{
    /**
     * Peuplement de la table parcours_semestres
     *
     * @return void
     */
    public function run()
    {
        ParcoursSemestre::truncate();

        //Test

        //Licence info
        for($i=1;$i<=6;$i++){
            ParcoursSemestre::create(["idParcours"=>1,'idSemestre'=>$i]);
        }

        //Master maths
        for($i=7;$i<=10;$i++){
            ParcoursSemestre::create(["idParcours"=>2,'idSemestre'=>$i]);
        }
        
    }
}
