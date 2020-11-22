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
        $nbProf=User::where('role',2)->count();

        $i=1;
        $k=13;
        $nbProf+=$k;
        while($i<=$nbEC){
            EC_Enseignant::create([
                'idEC'=>$i,
                'idEnseignant'=>$k
            ]);

            if($k==$nbProf-1){
                $k=13;
            }
            else{
                $k++;
            }
            $i++;
        }
    }
}
