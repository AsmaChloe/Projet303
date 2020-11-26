<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\diplome_responsable;

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

        diplome_responsable::create(['idDiplome'=>1,'idResponsable'=>1]);
        diplome_responsable::create(['idDiplome'=>2,'idResponsable'=>2]);
    }
}

