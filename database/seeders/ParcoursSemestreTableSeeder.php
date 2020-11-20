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
    }
}
