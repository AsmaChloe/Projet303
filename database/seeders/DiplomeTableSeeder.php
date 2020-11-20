<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Diplomes;

class DiplomeTableSeeder extends Seeder
{
    /**
     * Peuplement de la table diplomes
     *
     * @return void
     */
    public function run()
    {
        Diplomes::truncate();

        Diplomes::create(['typeDiplome'=>"Licence",'nomDiplome'=>"Informatique",'sigleDiplome'=>'INFO']);
        Diplomes::create(['typeDiplome'=>"Master",'nomDiplome'=>"Mathématiques et Applications",'sigleDiplome'=>"MA"]);

    }
}
