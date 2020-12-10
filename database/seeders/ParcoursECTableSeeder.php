<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Parcours_EC;

class ParcoursECTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parcours_EC::truncate();

        Parcours_EC::create([
            'idParcours' => 1,
            'idEC'=> 1
        ]);

        Parcours_EC::create([
            'idParcours' =>1,
            'idEC'=> 2
        ]);

        Parcours_EC::create([
            'idParcours' =>1,
            'idEC'=> 2
        ]);
    }
}
