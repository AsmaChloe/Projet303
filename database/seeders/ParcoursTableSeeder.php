<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Parcours;

class ParcoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parcours::truncate();

        Parcours::create(['nomParcours'=>"Informatique",'sigleParcours'=>"INFO",'idDiplome'=>1]);
        Parcours::create(['nomParcours'=>"Calcul Scientifque",'sigleParcours'=>"CS",'idDiplome'=>2]);
    }
}
