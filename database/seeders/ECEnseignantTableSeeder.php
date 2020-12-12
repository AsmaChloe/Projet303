<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\EC_Enseignant;
use \App\Models\EC;
use \App\Models\User;

class ECEnseignantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EC_Enseignant::truncate();

        $nbEC=EC::count();
        $listeProf=User::where('role',2)->get(); //Tableau de prof
        $nbProf=User::where('role',2)->count();

        for($i=1;$i<=11;$i++){
            for($j=13;$j<=19;$j++){
        EC_Enseignant::create([
            'idEC'=>$i,
            'idEnseignant' =>$j
        ]);
        }
    }
    }
}
