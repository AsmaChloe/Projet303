<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Semestre;

class SemestreTableSeeder extends Seeder
{
    /**
     * Peuplement de la table semestres
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=10;$i++){
            Semestre::create();
        }
    }
}
