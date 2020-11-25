<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Seance;
use \App\Models\Presentiel;

class PresentielTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Presentiel::truncate();

        //Presentiel de l'etudiant info 1 :

        //Les CM
        for($i=1;$i<=5;$i++){
            Presentiel::create([
                'idType' => 1, //Abscent
                'idSeance' => $i, //Seance 1 à 5 = Seances de CM INFO
                'idEtudiant' => 3 //EtuInfo1
            ]);
        }
        //Les TD
        for($i=6;$i<=10;$i++){
            Presentiel::create([
                'idType' => 2, //Present
                'idSeance' => $i, //Seance 6 à 10 = Seance de TD INFO
                'idEtudiant' => 3 //EtuInfo1
            ]);
        }
        //Les TD
        for($i=11;$i<=16;$i++){
            Presentiel::create([
                'idType' => 3, //Distance
                'idSeance' => $i, //Seance 11 à 16 = Seance de TP INFO
                'idEtudiant' => 3 //EtuInfo1
            ]);
        }

    }
}
