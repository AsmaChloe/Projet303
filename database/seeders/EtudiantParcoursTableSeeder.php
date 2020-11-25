<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Etudiant_Parcours;

class EtudiantParcoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Etudiant_Parcours::truncate();

        for($i=3;$i<=7;$i++){
            Etudiant_Parcours::create([
                'idEtudiant'=>$i,
                'idParcours'=>1
            ]);
        }

        for($i=8;$i<=12;$i++){
            Etudiant_Parcours::create([
                'idEtudiant'=>$i,
                'idParcours'=>2
            ]);
        }
        
    }
}
