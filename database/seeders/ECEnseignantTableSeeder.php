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

        $i=1;
        $j=0;
        //$k=13;
        //$listeProf+=$k;
        while($i<=$nbEC){
            EC_Enseignant::create([
                'idEC'=>$i,
                'idEnseignant' => $listeProf[$j]->id
            ]);

            if($j==sizeof($listeProf)-1){
                $j=0;
            }
            else{
                $j++;
            }
            $i++;
        }
    }
}
