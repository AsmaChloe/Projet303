<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\Notes;
use \App\Models\EC;
use \App\Models\User;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        Notes::truncate();

        //Pour le test : 1 note dans chaque matiere

        //Info
        for($i=3;$i<=7;$i++){
            for($j=1;$j<=6;$j++){
                Notes::create([
                    'valeurNote' => random_int(0,20),
                    'maxNote' => 20,
                    'idEtudiant' => $i,
                    'idEpreuve' => $j
                ]);
            }
        }

        //Maths
        for($i=8;$i<=12;$i++){
            for($j=7;$j<=11;$j++){
                Notes::create([
                    'valeurNote' => random_int(0,20),
                    'maxNote' => 20,
                    'idEtudiant' => $i,
                    'idEpreuve' => $j
                ]);
            }
        }

    }
}
