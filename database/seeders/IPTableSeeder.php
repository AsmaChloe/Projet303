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

        //IP::create(['idEC'=>,'idEtudiant'=>]);
    }
}
