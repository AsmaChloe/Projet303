<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Enseignant_Groupe;
use \App\Models\Groupes;
use \App\Models\User;

class EnseignantGroupeTableSeeder extends Seeder
{
    /**
     * peuplement de la base de donnée Enseignant_Groupe
     *
     * @return void
     */
    public function run()
    {
        //test
        Enseignant_Groupe::truncate();
        $nbGroupes=Groupes::count();
        $nbProfs=User::where('role',2)->count();

        $i=1;
        $k=13;
        $nbProfs+=13;

        while($i<=$nbGroupes){
            Enseignant_Groupe::create([
                'idEnseignant' =>$k,
                'idGroupe'=>$i
            ]);

            if($k==$nbProfs-1){
                $k=13;
            }
            else{
                $k++;
            }
            $i++;
        }

    }
}
