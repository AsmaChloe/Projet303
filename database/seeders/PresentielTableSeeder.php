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

        //Pour le test : presentiel du groupe S3F3 lors de la seance d'id 2
        Presentiel::create([
            'idType' => 2,
            'idSeance' => 1,
            'idEtudiant' => 3
        ]);

        Presentiel::create([
            'idType' => 2,
            'idSeance' => 1,
            'idEtudiant' => 4
        ]);
        Presentiel::create([
            'idType' => 1,
            'idSeance' => 1,
            'idEtudiant' => 5
        ]);
    }
}
