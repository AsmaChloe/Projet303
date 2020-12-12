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

        //LES EC DU PARCOURS 1
        for($i=1;$i<=6;$i++){
            Parcours_EC::create([
                'idParcours' => 1,
                'idEC'=>$i
            ]);
        }
        
        //LES EC DU PARCOURS 2
        for($i=7;$i<=11;$i++){
            Parcours_EC::create([
                'idParcours' => 2,
                'idEC'=>$i
            ]);
        }
    }
}
